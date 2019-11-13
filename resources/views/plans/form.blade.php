
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($plan)->name) }}" maxlength="250" placeholder="Enter name...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
    <label for="amount" class="col-md-2 control-label">Amount</label>
    <div class="col-md-10">
        <input class="form-control" name="amount" type="number" id="amount" value="{{ old('amount', optional($plan)->amount) }}" min="-2147483648" max="2147483647" placeholder="Enter amount...">
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('interval') ? 'has-error' : '' }}">
    <label for="interval" class="col-md-2 control-label">Interval</label>
    <div class="col-md-10">
        <select class="form-control" id="interval" name="interval">
            <option value="" style="display: none;" {{ old('interval', optional($plan)->interval ?: '') == '' ? 'selected' : '' }} disabled selected>Select period</option>
            @foreach (['year' => 'Year', 'month' => 'Month', 'week' => 'Week'] as $key => $period)
            <option value="{{ $key }}" {{ old('interval', optional($plan)->interval) == $key ? 'selected' : '' }}>
                    {{ $period }}
            </option>
            @endforeach
        </select>
    {!! $errors->first('interval', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="5" id="description">{{ old('description', optional($plan)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

