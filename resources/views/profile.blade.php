                                                            @foreach ($citiesData as $ctData)
                                                            <tr>
                                                                <td>
                                                                    1
                                                                </td>
                                                                <td>
                                                                    {{ $ctData[1]['name'] }}
                                                                </td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn <?php if ($ctData[1]['status'] == 'Public') {
                                                                            echo 'btn-success';
                                                                            } else {
                                                                            echo 'btn-default';
                                                                            } ?> dropdown-toggle"
                                                                            type="button" id="dropdownMenuButton"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                            {{ $ctData[1]['status'] }}
                                                                        </button>
                                                                        <div class="dropdown-menu"
                                                                            aria-labelledby="dropdownMenuButton">

                                                                            <a class="dropdown-item"
                                                                                href="/admin/public_city/{{ $ctData[0] }}">Public</a>
                                                                            <a class="dropdown-item"
                                                                                href="/admin/private_city/{{ $ctData[0] }}">Private</a>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>

                                                                    <div class="row">
                                                                        
                                                                        <button class="btn btn-warning btn-sm"
                                                                            onclick="editCity('{{ $ctData[0] }}','{{ $ctData[1]['name'] }}')">Edit
                                                                            <div class="ripple-container"></div>
                                                                        </button>
                                                                        <form method="post" action="/admin/del_city">
                                                                            @csrf
                                                                            <button class="btn btn-danger btn-sm"
                                                                                name="id"
                                                                                value="{{ $ctData[0] }}">Delete<div
                                                                                    class="ripple-container"></div>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endforeach