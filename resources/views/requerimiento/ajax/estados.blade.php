@if($item->estado_id == 'CEES00000001') 
    <span class="badge badge-success">{{$item->estado_nombre}}</span>
@else
  @if($item->estado_id == 'CEES00000002') 
      <span class="badge badge-danger">{{$item->estado_nombre}}</span>
  @else
    @if($item->estado_id == 'CEES00000003') 
        <span class="badge badge-danger">{{$item->estado_nombre}}</span>
    @else    
      @if($item->estado_id == 'CEES00000004') 
          <span class="badge badge-warning">{{$item->estado_nombre}}</span>
      @else    
        @if($item->estado_id == 'CEES00000005') 
            <span class="badge badge-warning">{{$item->estado_nombre}}</span>
        @else    
          @if($item->estado_id == 'CEES00000006') 
              <span class="badge badge-warning">{{$item->estado_nombre}}</span>
          @else    
            @if($item->estado_id == 'CEES00000007') 
                <span class="badge badge-primary">{{$item->estado_nombre}}</span>
            @else    
                <span class="badge badge-danger">{{$item->estado_nombre}}</span>
            @endif
          @endif
        @endif
      @endif
    @endif
  @endif
@endif