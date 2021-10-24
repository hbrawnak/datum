@if (count($users) > 0)
    <div class="row">
        <div class="d-flex justify-content-end">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item {{ $users->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link"
                           href="{{ $users->appends(['year' => $year, 'month' => $month])->previousPageUrl() }}"
                           aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <li class="page-item"><p class="page-link">{{ $users->firstItem()}} - {{$users->lastItem() }}
                            of {{ $users->total() }}</p></li>

                    <li class="page-item {{ $users->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link"
                           href="{{ $users->appends(['year' => $year, 'month' => $month])->nextPageUrl() }}"
                           aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Birthday</th>
                <th scope="col">Phone</th>
                <th scope="col">IP</th>
                <th scope="col">Country</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->birthday }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->ip }}</td>
                    <td>{{ $user->country }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <p> No data to load. </p>
@endif
