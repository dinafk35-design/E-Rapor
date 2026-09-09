<form action="{{ route('data-guru.store') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label class="form-label">Nama Guru</label>

        <input
            type="text"
            name="nama_guru"
            class="form-control"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>

        <textarea
            name="alamat"
            class="form-control"
            required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>

        <input
            type="email"
            name="email"
            class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Telepon</label>

        <input
            type="text"
            name="telepon"
            class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        💾 Simpan
    </button>

</form>