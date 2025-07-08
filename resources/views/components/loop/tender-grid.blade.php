@props(['qty' => 4])

@php
    use App\Models\Tender;
    $posts = Tender::with(['tenderYear', 'tenderStatus', 'tenderLocation'])
        ->limit($qty)
        ->get();
@endphp

<div class="grid sm:grid-cols-2 lg:grid-cols-4 grid-cols-1 gap-7 lg:gap-5">
    <x-loop.tender label="Tender Sistem ERP 1" date="06/01/2025"
        desc="
                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                "
        url="#" tag="terbaru" />

    <x-loop.tender label="Tender Sistem ERP 2" date="06/01/2025"
        desc="
                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                "
        url="#" tag="terbaru" />

    <x-loop.tender label="Tender Sistem ERP 3" date="06/01/2025"
        desc="
                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                "
        url="#" tag="terbaru" />

    <x-loop.tender label="Tender Sistem ERP 4" date="06/01/2025"
        desc="
                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.
                "
        url="#" tag="terbaru" />


</div>
