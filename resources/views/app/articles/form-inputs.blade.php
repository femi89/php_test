@php $editing = isset($article) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="subject"
            label="Subject"
            value="{{ old('subject', ($editing ? $article->subject : '')) }}"
            maxlength="255"
            placeholder="Subject"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="slug"
            label="Slug"
            value="{{ old('slug', ($editing ? $article->slug : '')) }}"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="body" label="Body" maxlength="255" required
            >{{ old('body', ($editing ? $article->body : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
