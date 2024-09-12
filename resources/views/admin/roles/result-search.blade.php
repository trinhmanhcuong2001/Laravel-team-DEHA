            @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td class="w-25">
                    @foreach ($role->permissions as $permission)
                        <span class="badge bg-info text-white">{{ $permission->name }}</span>
                    @endforeach
                </td>
                <td>{{ $role->created_at }}</td>
                <td>{{ $role->updated_at }}</td>
                <td class="d-flex">
                    <a href="{{route('roles.edit', $role->id)}}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                    <form action="{{route('roles.destroy', $role->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach