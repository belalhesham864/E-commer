@if($status == 'completed')
    <span class="badge badge-success">{{ ucfirst($status) }}</span>
@elseif($status == 'delivered')
    <span class="badge badge-primary">{{ ucfirst($status) }}</span>
@elseif($status == 'cancelled')
    <span class="badge badge-danger">{{ ucfirst($status) }}</span>
@else
    <span class="badge badge-warning">{{ ucfirst($status) }}</span>
@endif
