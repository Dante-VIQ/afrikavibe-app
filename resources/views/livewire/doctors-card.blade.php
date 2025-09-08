<div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">Destinations</h4>
                        <p class="card-subtitle card-subtitle-dash">You can manage your destinations here</p>
                    </div>
                    <div x-data="{ show: false }" x-cloak>
                        <div>
                            <x-button x-on:click.prevent="show = true"
                                class="btn btn-primary btn-lg text-white mb-0 me-0"><i
                                    class="mdi mdi-account-plus"></i>Add
                                New Destination</x-button>
                            <div x-show="show" x-on:click.outside.prevent="show = false"
                                class="mx-auto z-9 top-1/3 left-1/3">
                                @include('livewire.includes.doctor-create')
                            </div>
                        </div>

                    </div>
                </div>
                <div class="table-responsive  mt-1">
                    <table class="table select-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check form-check-flat mt-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" aria-checked="false"
                                                id="check-all"><i class="input-helper"></i></label>
                                    </div>
                                </th>
                                <th>Destination</th>
                                <th>Created by</th>
                                <th>Manage</th>
                                <th>Clicks</th>
                            </tr>
                        </thead>
                        @unless ($doctors->isEmpty())
                            @foreach ($this->doctors as $doctor)
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-flat mt-0">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" aria-checked="false"><i
                                                        class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <img src="{{ asset('storage/' . $doctor->image) }}" alt="">
                                                <div>
                                                    <h6>{{ $doctor->name }}</h6>
                                                    <p>{{ $doctor->category }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{ $doctor->user->name }}</h6>
                                            <p>{{ $doctor->user->id }}</p>
                                        </td>
                                        <td>

                                            <div
                                                class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                <a href="/doctors/{{ $doctor->id }}/edit"
                                                    class="text-blue-400 px-6 py-2 rounded-xl"><i
                                                        class="fa-solid fa-pen-to-square"></i>
                                                    Edit</a>
                                            </div>
                                            <div class="progress progress-md">
                                                <form method="POST" action="/doctors/{{ $doctor->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-500"><i class="fa-solid fa-trash"></i>
                                                        Delete</button>
                                                </form>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="badge badge-opacity-warning">
                                                In progress</div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach

                        @endunless
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div>
        <livewire:blog-card />
    </div>
</div>
