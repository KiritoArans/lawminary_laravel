@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Forums</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Forum ID</th>
                    <th>Forum Name</th>
                    <th>Forum Description</th>
                    <th>Members Count</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forums as $forum)
                    <tr>
                        <td>{{ $forum->id }}</td>
                        <td>{{ $forum->forum_name }}</td>
                        <td>{{ $forum->forum_desc }}</td>
                        <td>{{ $forum->mem_count }}</td>
                        <td>{{ $forum->created_at }}</td>
                        <td>
                            <button
                                class="btn btn-primary editButton"
                                data-id="{{ $forum->id }}"
                                data-name="{{ $forum->forum_name }}"
                                data-desc="{{ $forum->forum_desc }}"
                                data-members="{{ $forum->mem_count }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                            >
                                Edit
                            </button>
                            <form
                                action="{{ route('admin.forums.delete', $forum->id) }}"
                                method="POST"
                                style="display: inline-block"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-danger deleteButton"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@include('includes_forums.forums_edit_inc')
