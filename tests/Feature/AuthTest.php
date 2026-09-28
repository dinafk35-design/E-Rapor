<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_available_to_guests(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Login E-Rapor SMK');
    }

    public function test_protected_pages_redirect_guests_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login'));
    }

    public function test_all_role_dashboards_redirect_guests_to_login(): void
    {
        foreach (['/admin-dashboard', '/guru-dashboard', '/siswa-dashboard'] as $uri) {
            $this->get($uri)->assertRedirect(route('login'));
        }
    }

    public function test_authenticated_users_are_redirected_to_their_role_dashboard(): void
    {
        foreach (['admin', 'guru', 'siswa'] as $role) {
            $user = User::factory()->create(['role' => $role]);

            $this->actingAs($user)
                ->get('/')
                ->assertRedirect(route("{$role}.dashboard"));
        }
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'username' => 'admin',
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_guru_and_siswa_are_redirected_to_their_role_dashboards(): void
    {
        foreach (['guru', 'siswa'] as $role) {
            $user = User::factory()->create([
                'username' => $role,
                'role' => $role,
            ]);

            $response = $this->post('/login', [
                'username' => $role,
                'password' => 'password',
            ]);

            $response->assertRedirect(route("{$role}.dashboard"));
            $this->assertAuthenticatedAs($user);

            $this->post('/logout');
        }
    }

    public function test_invalid_credentials_are_rejected(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'role' => 'admin',
        ]);

        $response = $this->from('/login')->post('/login', [
            'username' => 'admin',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('username');
        $this->assertGuest();
    }

    public function test_logout_control_is_rendered_in_sidebar(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertSee(route('logout'), false)
            ->assertSee('type="submit"', false);
    }

    public function test_authenticated_users_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_authenticated_user_can_view_semester_page(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('semester'))
            ->assertOk()
            ->assertSee('Daftar Semester')
            ->assertSee('2026/2027');
    }

    public function test_authenticated_user_can_view_pengguna_page(): void
    {
        $user = User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'role' => 'admin',
        ]);

        $this->actingAs($user)
            ->get(route('pengguna'))
            ->assertOk()
            ->assertSee('Daftar Pengguna')
            ->assertSee('admin');
    }

    public function test_role_middleware_rejects_an_unauthorized_role(): void
    {
        $user = User::factory()->create(['role' => 'siswa']);

        $this->actingAs($user)
            ->get('/admin-dashboard')
            ->assertForbidden();
    }

    public function test_authenticated_user_can_view_profile(): void
    {
        $user = User::factory()->create([
            'name' => 'Budi Santoso',
            'username' => 'budi',
        ]);

        $this->actingAs($user)
            ->get('/profile')
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertSee('budi');
    }

    public function test_user_can_update_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }
}
