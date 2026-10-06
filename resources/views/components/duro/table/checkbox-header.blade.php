<th scope="col" {{ $attributes->only('class')->class('w-10') }}>
    <input type="checkbox" class="duro-check" aria-label="Select all rows" {{ $attributes->except('class') }}>
</th>
