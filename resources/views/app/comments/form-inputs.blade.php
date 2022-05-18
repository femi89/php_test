@php $editing = isset($comment) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="article_id" label="Article">
            @php $selected = old('article_id', ($editing ? $comment->article_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Article</option>
            @foreach($articles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User">
            @php $selected = old('user_id', ($editing ? $comment->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="message" label="Message" maxlength="255"
            >{{ old('message', ($editing ? $comment->message : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="isGuest"
            label="Is Guest"
            :checked="old('isGuest', ($editing ? $comment->isGuest : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="guest_name"
            label="Guest Name"
            value="{{ old('guest_name', ($editing ? $comment->guest_name : '')) }}"
            maxlength="255"
            placeholder="Guest Name"
        ></x-inputs.text>
    </x-inputs.group>
</div>
