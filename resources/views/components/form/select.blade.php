@props( [
	'name',
	'options' =>[],
	'label' => null,
	'placeholder' => null,
	'optionValue' => 'id',
	'optionLabel' => 'name'
	])
<select class="form-control" style="border: 2px solid lightgrey" wire:model="{{ $name }}">
    <option value="">{{ $placeholder }}</option>
    @foreach ($options as $key => $value)
        <option value="{{ $key  }}">{{ $value }}</option>
    @endforeach
</select>
