@extends('admin::layouts.app')

@section('topbar2-links-left')

    <div class="mw-toolbar-back-button-wrapper">
        <div class="main-toolbar mw-modules-toolbar-back-button-holder mb-3 " id="mw-modules-toolbar" style="">

            @if(isset($isShop))
                <a href="{{route('admin.shop.category.index')}}">
                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 96 960 960" width="28"><path d="M480 896 160 576l320-320 47 46.666-240.001 240.001H800v66.666H286.999L527 849.334 480 896Z"></path></svg>
                </a>
            @else
            <a href="{{route('admin.category.index')}}">
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 96 960 960" width="28"><path d="M480 896 160 576l320-320 47 46.666-240.001 240.001H800v66.666H286.999L527 849.334 480 896Z"></path></svg>
            </a>

            @endif

        </div>
    </div>

@endsection

@section('topbar2-links-right')

    <li>
        <button type="button" onclick="save_cat(this);" dusk="category-save" class="btn btn-dark" form="quickform-edit-content">
            <i class="mdi mdi-content-save me-1"></i> <?php _e('Save') ?>
        </button>
    </li>

@endsection


@section('content')

    <div class="d-flex">

    <script>
        mw.require('content.js', true);
    </script>

    <div class="module-content col-xxl-10 col-lg-11 col-12 mx-auto">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    @php
                        $isShopAttribute = 0;
                        if (isset($isShop)) {
                             $isShopAttribute = 1;
                        }
                    @endphp

                    @if($isShopAttribute == 1)
                        <h1 class="main-pages-title"> {{ 'Add category to Shop' }}</h1>
                    @else
                       <h1 class="main-pages-title"> {{ 'Add category to Website' }}</h1>
                    @endif


                    <div>
                        @if($isShopAttribute == 1)
                        <a href="<?php echo route('admin.shop.category.create')."?parent=shop"; ?>"
                           class="btn btn-dark"
                        >
                            <svg fill="currentColor" class="me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M446.667 856V609.333H200v-66.666h246.667V296h66.666v246.667H760v66.666H513.333V856h-66.666Z"></path></svg>
                            {{"New category"}}
                        </a>
                        @else
                        <a href="<?php echo route('admin.category.create')."?parent=blog"; ?>"
                           class="btn btn-dark"
                        >
                            <svg fill="currentColor" class="me-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M446.667 856V609.333H200v-66.666h246.667V296h66.666v246.667H760v66.666H513.333V856h-66.666Z"></path></svg>
                            {{"New category"}}
                        </a>
                        @endif
                    </div>
                </div>


                <module type="categories/edit_category" is_shop="{{$isShopAttribute}}" id="admin-category-edit" data-category-id="{{$id}}"  />
            </div>
        </div>
    </div>

</div>
@endsection
