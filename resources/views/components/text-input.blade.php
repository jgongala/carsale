<div class="relative">
    @if ($formRef)
    <button type="button" class="absolute top-0 right-0 flex h-full items-center pr-2" 
            @click="$refs['input-{{ $name }}'].value = ''; $refs['{{ $formRef }}'].submit();">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4 text-slate-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    @endif
    <input x-ref="input-{{ $name }}" type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        name="{{ $name }}" value="{{ old($name, $value) }}" id="{{ $name }}"
        class = "w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-200 placeholder:text-slate-300 focus:ring-2" />
  </div>