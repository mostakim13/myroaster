<div>
    <div wire:ignore.self class="modal fade" id="editDataModal{{ $row->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable" role="document">
            <form wire:submit.prevent="submit" id="TimeKeeperForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="exampleModalLongTitle">Roaster Approval Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">

                            <div class="form-group row">
                                <div class="col-sm-6 @error('roaster_start_date') has-error @enderror">
                                    <label for="username" class="control-label">
                                        Roaster Start Time test
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control reative" placeholder="Start"
                                            id="shift_start" name="shift_start" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 @error('roaster_end_date') has-error @enderror">
                                    <label for="username" class="control-label">
                                        Roaster Ends Time
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control reactive" placeholder="Contact No"
                                            id="shift_end" name="shift_end" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 @error('duration') has-error @enderror">
                                    <label for="username" class="control-label">
                                        Duration
                                    </label>

                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Durarion" id="username"
                                            wire:model.defer="date_to_display" wire:change="calculate2()"
                                            disabled="disabled">
                                    </div>

                                    <div class="input-group">
                                        <input type="hidden" class="form-control" placeholder="Durarion" id="username"
                                            wire:model.defer="date_to_display" wire:change="calculate2()"
                                            disabled="disabled">
                                    </div>
                                </div>

                                <div class="col-sm-6 @error('rate') has-error @enderror">
                                    <label for="username" class="control-label">
                                        Hourly Rate
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control reactive" placeholder="Rate" id="rate"
                                            name="ratePerHour">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 @error('amount') has-error @enderror">
                                    <label for="username" class="control-label">
                                        Amount
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Amount" id="amount"
                                            name="amount">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 @error('roaster_type_id') has-error @enderror">
                                    <label for="client_status" class="control-label">
                                        Select Roaster Type
                                    </label>
                                    <div class="input-group">
                                        <select name="client_status" class="form-control"
                                            wire:model='roaster_type_id'>
                                            <option>Please Select Roaster Type</option>
                                            @foreach ($roaster_types as $roaster_type)
                                                <option value="{{ $roaster_type->id }}">
                                                    {{ $roaster_type->roaster_type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- @if (is_null($update_id)) --}}
                        <button type="submit" class="btn btn-primary">Create Roaster</button>
                        {{-- @else
                            <button type="submit" class="btn btn-success">Update Roaster</button>
                        @endif --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
