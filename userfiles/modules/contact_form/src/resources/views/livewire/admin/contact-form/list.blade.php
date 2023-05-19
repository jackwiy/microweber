<div>
    <div class="my-3">
        <div class="form-group">
            <label class="form-label d-block mb-2">Your form lists</label>
            <select class="form-select" data-width="100%">
                <option selected="selected">All lists</option>
                <option>Default list (0)</option>
            </select>
        </div>
    </div>

    <div class="form-list-toolbar my-4 d-flex align-items-center">
        <div class="col-sm-6">
            <label class="form-label d-inline-block">Entries for list: <span>All lists</span></label>
        </div>
        <div class="col-sm-6 text-end text-right">
            <div class="contact-form-export-search text-end text-right d-inline-block">
                <div class="row g-2 p-0">
                    <div class="col">
                        <input autocomplete="off" class="form-control" type="text" placeholder="Search for data">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4 bg-silver">
        @foreach($formsData as $formData)
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col" style="max-width:55px;">
                    <i class="mdi mdi-email text-primary mdi-24px"></i>
                </div>
                <div class="col-10 col-sm item-id">
                    <span class="text-primary">#{{$formData->id}}</span>
                </div>
                <div class="col-6 col-sm">
                    {{$formData->created_at->format('M d, Y')}}
                    <small class="text-muted mb-2 font-weight-bold d-block">
                        {{$formData->created_at->format('h:i A')}}
                    </small>
                </div>
                <div class="col-6 col-sm">
                    {{$formData->created_at->diffForHumans()}}
                </div>
                <div class="col-2 text-end">
                    <a href="#" class="btn btn-link" onclick="Livewire.emit('openModal', 'admin-marketplace-item-modal', {{ json_encode(['formDataId'=>$formData->id]) }})">
                        {{_e('View')}}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>
<div class="row mt-4">
    <div class="col-sm-10 text-center">
        <div class="pagination justify-content-center">
            <div class="pagination-holder">
                {{$formsData->links()}}
            </div>
        </div>
    </div>
    <div class="col-sm-2 text-center text-sm-right">
        <div class="form-group">
            <form method="get">
                <small>Show items per page</small>
                <select class="form-select" data-size="5" data-width="100px" data-style="btn-sm" onchange="this.form.submit()">
                    <option value="">Select</option>
                    <option value="10">10</option>
                    <option value="30" selected="">30</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
            </form>
        </div>
    </div>
</div>
<div class="row mt-1">
    <div class="col-sm-6">
        <div class="export-label">
            <span>Export data</span>
            <span class="btn btn-outline-primary btn-sm">Excel</span>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="text-end text-right">
            <strong>Total:</strong>
            <span>0 messages in this list: </span>
        </div>
    </div>
</div>
