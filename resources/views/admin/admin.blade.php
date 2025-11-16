<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            @include('admin.head')

                    <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                            @include('admin.market')
                            <div class="row flex-grow">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card card-rounded table-darkBGImg">
                                        <div class="card-body">
                                            <div class="col-sm-8">
                                                <h3 class="text-white upgrade-info mb-0"> Enhance
                                                    your <span class="fw-bold">Campaign</span> for
                                                    better outreach </h3>
                                                <a href="#" class="btn btn-info upgrade-btn">Upgrade
                                                    Account!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row flex-grow">
                                @include('admin.requests')
                            </div>
                            <div class="row flex-grow">
                                @include('admin.events')
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="row flex-grow">

                                <livewire:todo-list />
                            </div>
                            @include('admin.charts')
                            <div class="row flex-grow">
                                <div class="col-12 grid-margin stretch-card">
                                    @include('admin.perfomers')
                                </div>
                            </div>
                        </div>
                    </div>

        </div>
    </div>
</div>
