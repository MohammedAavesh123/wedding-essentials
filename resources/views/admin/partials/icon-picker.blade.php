<div class="row">
    @php
    $icons = [
        ['value' => 'fa-couch', 'label' => 'Sofa'],
        ['value' => 'fa-bed', 'label' => 'Bed'],
        ['value' => 'fa-chair', 'label' => 'Chair'],
        ['value' => 'fa-door-open', 'label' => 'Door'],
        ['value' => 'fa-utensils', 'label' => 'Kitchen'],
        ['value' => 'fa-bath', 'label' => 'Bathroom'],
        ['value' => 'fa-lightbulb', 'label' => 'Lighting'],
        ['value' => 'fa-tv', 'label' => 'Electronics'],
        ['value' => 'fa-blender', 'label' => 'Appliances'],
        ['value' => 'fa-paint-roller', 'label' => 'Decor'],
        ['value' => 'fa-fan', 'label' => 'Fan'],
        ['value' => 'fa-snowflake', 'label' => 'Cooler/AC'],
        ['value' => 'fa-temperature-low', 'label' => 'Fridge'],
        ['value' => 'fa-door-closed', 'label' => 'Almirah'],
        ['value' => 'fa-ring', 'label' => 'Jewelry'],
        ['value' => 'fa-tshirt', 'label' => 'Clothes'],
        ['value' => 'fa-shoe-prints', 'label' => 'Footwear'],
        ['value' => 'fa-box', 'label' => 'Storage'],
        ['value' => 'fa-tag', 'label' => 'Other'],
    ];
    $selectedIcon = $selectedIcon ?? 'fa-couch';
    @endphp
    
    @foreach($icons as $icon)
    <div class="col-md-2 col-sm-3 col-4 mb-3">
        <input type="radio" name="icon" value="{{ $icon['value'] }}" id="icon-{{ str_replace('fa-', '', $icon['value']) }}" class="d-none icon-radio" {{ $selectedIcon == $icon['value'] ? 'checked' : '' }}>
        <label for="icon-{{ str_replace('fa-', '', $icon['value']) }}" class="icon-option">
            <i class="fas {{ $icon['value'] }} fa-3x"></i>
            <span class="d-block mt-2 small">{{ $icon['label'] }}</span>
        </label>
    </div>
    @endforeach
</div>

<style>
.icon-option {
    display: block;
    text-align: center;
    padding: 15px 10px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fff;
}
.icon-option:hover {
    border-color: #007bff;
    background: #f8f9fa;
    transform: translateY(-2px);
}
.icon-radio:checked + .icon-option {
    border-color: #007bff;
    background: #e7f3ff;
    box-shadow: 0 0 10px rgba(0,123,255,0.3);
}
.icon-option i {
    color: #6c757d;
}
.icon-radio:checked + .icon-option i {
    color: #007bff;
}
</style>
