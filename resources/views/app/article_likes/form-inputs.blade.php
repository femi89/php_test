@php $editing = isset($articleLike) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="like"
            label="Like"
            :checked="old('like', ($editing ? $articleLike->like : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="dis_like"
            label="Dis Like"
            :checked="old('dis_like', ($editing ? $articleLike->dis_like : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="article_id" label="Article">
            @php $selected = old('article_id', ($editing ? $articleLike->article_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Article</option>
            @foreach($articles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User">
            @php $selected = old('user_id', ($editing ? $articleLike->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
