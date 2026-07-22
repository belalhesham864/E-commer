@foreach ($item->attributevalues as $value )
<div class="badge border-primary primary badge-border">
    {{ $value->value }}
</div>
    
@endforeach