<div class="row g-3">
    <div class="col-12 col-sm-6">
        <input wire:model="form.name" type="text" class="form-control border-0" placeholder="Your Name"
            style="height: 55px;">
    </div>
    <div class="col-12 col-sm-6">
        <input wire:model="form.email" type="email" class="form-control border-0" placeholder="Your Email"
            style="height: 55px;">
    </div>
    <div class="col-12 col-sm-6">
        <input wire:model="form.mobile" type="text" class="form-control border-0" placeholder="Your Mobile"
            style="height: 55px;">
    </div>
    <div class="col-12 col-sm-6">
        <select wire:model.live="form.doctor" class="form-select border-0" style="height: 55px;">
            <option selected>Choose Destination</option>
                {{-- @foreach ($this->doctors as $doctor)
                    <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                @endforeach --}}
           
        </select>
    </div>
    {{-- <div class="col-12 col-sm-6">
        <div class="date" id="date">
            <input wire:model="form.start" type="text" class="form-control border-0" placeholder="Your Location"
                style="height: 55px;">
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="time" id="time" data-target-input="nearest">
            <input wire:model="form.end" type="text" class="form-control border-0 datetimepicker-input"
                placeholder="Choose Date" data-target="#time" data-toggle="datetimepicker" style="height: 55px;">
        </div>
    </div> --}}
    {{-- <div class="col-12">
        <textarea wire:model="form.problem" class="form-control border-0" rows="5" placeholder="Describe your problem"></textarea>
    </div> --}}
    <div class="col-12">
        <button class="btn btn-primary w-100 py-3" type="submit">Book
            Appointment</button>
    </div>
</div>
