<div>
    <div class="modal-body">
        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" id="createTask">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Task Name</label>
                        <input class="form-control" name="name" type="text">
                    </div>
                    <div class="alert alert-danger d-none" id="name"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Deadline</label>
                        <div class="cal-icon">
                            <input name="deadline" class="form-control datetimepicker" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="alert alert-danger d-none" id="deadline"></div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group" wire:ignore>
                        <label>Priority</label>
                        <select class="select" name="priority">
                            <option>High</option>
                            <option>Medium</option>
                            <option>Low</option>
                        </select>
                    </div>
                    <div class="alert alert-danger d-none" id="priority"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Select Sector</label>
                        <select class="form-control select_sector" name="sector_id" wire:model='sectorId' id="add_task_select">
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Select Task Leader</label>
                        <select class="form-control" name="user_id" id="add_task_employee" name="userId">
                            <option>Select Task Leader</option>
                            @if (is_array($employees) || is_object($employees))
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="alert alert-danger d-none" id="user_id"></div>
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea rows="4" class="form-control" name="description" placeholder="Enter description here"></textarea>
            </div>
            <div class="alert alert-danger d-none" id="description"></div>

            <div class="form-group">
                <label>Upload Files</label>
                <input class="form-control" name="file" type="file">
            </div>
            <div class="alert alert-danger d-none" id="file"></div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

@push('js')
<script>
    // document.addEventListener('livewire:load', function () {
    //         $('#deadline').on('dp.change', function (e) {
    //             @this.set('deadline', e.target.value);
    //             $('#deadline').toggle(true);
    //         });
    // });
</script>
@endpush
