<div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">Headers</h4>
                        <p class="card-subtitle card-subtitle-dash">You can manage your headers here</p>
                    </div>
                    <div x-data="{ show: false }" x-cloak>
                        <button x-on:click.prevent="show = true" class="btn btn-primary btn-lg text-white mb-0 me-0" type="submit"><i
                                class="mdi mdi-account-plus"></i>Add
                            New Header</button>

                            <div class="mx-auto z-9 top-1/3 left-1/3" x-show="show" x-on:click.outside.prevent="show = false">
                                @include('livewire.includes.header-create')
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
                                <th>Culture</th>
                                <th>Created by</th>
                                <th>Manage</th>
                                <th>Clicks</th>
                            </tr>
                        </thead>
                        @unless (count($headers) == 0)
                            @foreach ($this->headers as $header)
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
                                                <img src="{{ asset('storage/' . $header->image) }}" alt="">
                                                <div>
                                                    <h6>{{ $header->name }}</h6>
                                                    <p>{{ $header->category }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{ $header->user->name }}</h6>
                                            <p>{{ $header->user->id }}</p>
                                        </td>
                                        <td>
                                            <div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                    <p class="text-success">79%
                                                    </p>
                                                    <p>85/162</p>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 85%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
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

