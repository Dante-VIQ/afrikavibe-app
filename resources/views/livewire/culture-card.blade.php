<div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">Cultures</h4>
                        <p class="card-subtitle card-subtitle-dash">You can manage your cultures here</p>
                    </div>
                    <div x-data="{ show: false }" x-cloak>
                        <div>
                            <x-button x-on:click.prevent="show = true" class="btn btn-primary btn-lg text-white mb-0 me-0"
                                type="submit"><i class="mdi mdi-account-plus"></i>Add
                                New Culture</x-button>
                        </div>
                        <div x-show="show" x-on:click.outside.prevent="show = false"
                            class="mx-auto z-9 top-1/3 left-1/3">
                            @include('livewire.includes.culture-create')
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
                        @unless ($cultures->isEmpty())
                            @foreach ($this->cultures as $culture)
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
                                                <img src="{{ asset('storage/' . $culture->image) }}"
                                                    alt="{{ $culture->name }}">
                                                <div>
                                                    <h6>{{ $culture->name }}</h6>
                                                    <p>{{ $culture->category }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{ $culture->user->name }}</h6>
                                            <p>{{ $culture->user->id }}</p>
                                        </td>
                                        <td>

                                            <div
                                                class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                                    <div x-data="{ show: false }" x-cloak>
                        <div>
                            <x-button x-on:click.prevent="show = true" class="btn btn-primary btn-lg text-white mb-0 me-0"
                                type="submit"><i class="mdi mdi-account-plus"></i>Add
                edit</x-button>
                        </div>
                        <div x-show="show" x-on:click.outside.prevent="show = false"
                            class="mx-auto z-9 top-1/3 left-1/3">
                            @include('livewire.includes.culture-edit')
                        </div>
                    </div>
                                            </div>
                                            <div class="progress progress-md">
                                                <form method="POST" action="/cultures/{{ $culture->id }}">
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

</div>
