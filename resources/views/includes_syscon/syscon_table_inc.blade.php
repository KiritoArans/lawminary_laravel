<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Content</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Your table rendering with edit buttons -->
        @foreach ($sysconData as $syscon)
            <tr>
                <td>{{ $syscon->id }}</td>
                <td>{{ $syscon->name }}</td>
                <td>{{ $syscon->content }}</td>
                <td>{{ $syscon->created_at }}</td>
                <td>{{ $syscon->updated_at }}</td>
                <td>
                    <!-- Edit Button -->
                    <button
                        class="btn btn-primary editButton"
                        data-id="{{ $syscon->id }}"
                        data-name="{{ $syscon->name }}"
                        data-content="{{ $syscon->content }}"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal"
                    >
                        Edit
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('includes_syscon.syscon_edit_inc')
