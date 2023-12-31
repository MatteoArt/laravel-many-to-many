@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Immagine</th>
                <th scope="col">Linguaggi/Tecnologie</th>
                <th scope="col">Categoria</th>
                <th scope="col">Repository</th>
                <th scope="col">Pagina progetto</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row"> {{ $project->id }} </th>
                    <td>
                        {{ $project->title }}
                    </td>
                    <td> {{ $project->description }} </td>
                    <td class="my-table-img">
                        <img class="img-fluid" src="{{ asset('/storage/' . $project->img) }}" alt="img project">
                    </td>
                    <td>
                        @foreach ($project->technologies as $tecnology)
                        <ul class="ps-0 my-list-technologies">
                            <li>{{ $tecnology->name }}</li>
                        </ul>
                        @endforeach
                    </td>
                    <td>
                        @if ($project->type_id)
                            <span>
                                {{ $project->type->name }}
                            </span>
                        @else
                            <span>//</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ $project->repository }}" target="_blank"> {{ $project->repository }} </a>
                    </td>
                    <td>
                        @if ($project->page_project)
                           <a href="{{ $project->page_project }}" target="_blank"> {{ $project->page_project }} </a>
                        @else
                           <span>//</span>
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-info">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form class="d-inline-block" action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                            @csrf

                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
