<div id="widget_1" class="mt-4">
    <h5><b>Area Hierarchy Based on Complaint</b></h5>
    <div class="flow-container">
        <div class="flow">
            {{-- elsecomplaint_count --}}
            @php
            $i = 1;
            @endphp
            @foreach($topDistricts as $key => $topDistrict)
            @if($i == 1)
            <div class="node color color{{ $i }}" id="w{{ $i }}"><span><b>{{ $topDistrict->name }} ~ {{ $topDistrict->bn_name }}</b></span></div>
            @else
            <div class="button-down"></div>
            <div class="node color color{{ $i }}" id="w{{ $i }}"><span><b>{{ $topDistrict->name }} ~ {{ $topDistrict->bn_name }}</b></span></div>
            @endif
            <?php 
              $i++;
              ?>
            @endforeach
        </div>
    </div>
</div>
