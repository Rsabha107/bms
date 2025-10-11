@extends('bbs.template.customer.customer_template')
@section('main')


<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-5 pb-9">

    <div class="container-small cart">
        <nav class="mb-3" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#!">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Services</li>
            </ol>
        </nav>
        <h2 class="mb-6">Services</h2>
        <div class="row g-5">
            <div class="col-12 col-lg-12">
                <div id="cartTable" data-list='{"valueNames":["products","color","size","price","quantity","total"],"page":10}'>
                    <div class="table-responsive scrollbar mx-n1 px-1">
                        <table class="table fs-9 mb-0 border-top border-translucent">
                            <thead>
                                <tr>
                                    <th class="sort white-space-nowrap align-middle fs-10" scope="col"></th>
                                    <th class="sort white-space-nowrap align-middle" scope="col" style="min-width:250px;">SERVICE</th>
                                    <th class="sort align-middle ps-5" scope="col" style="width:200px;">QUANTITY</th>
                                    <th class="sort text-end align-middle pe-0" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="cart-table-body">
                                <tr class="cart-table-row btn-reveal-trigger">
                                    <td class="align-middle white-space-nowrap py-0"><a class="d-block border border-translucent rounded-2" href="../../../apps/e-commerce/landing/product-details.html"><img src="../../../assets/img//products/1.png" alt="" width="53" /></a></td>
                                    <td class="products align-middle"><a class="fw-semibold mb-0 line-clamp-2" href="../../../apps/e-commerce/landing/product-details.html">Fitbit Sense Advanced Smartwatch with Tools for Heart Health, Stress Management &amp; Skin Temperature Trends, Carbon/Graphite, One Size (S &amp; L Bands)</a></td>
                                    <td class="quantity align-middle fs-8 ps-5">
                                        <div class="input-group input-group-sm flex-nowrap" data-quantity="data-quantity">
                                            <button class="btn btn-sm px-2" data-type="minus">-</button>
                                            <input class="form-control text-center input-spin-none bg-transparent border-0 px-0" type="number" min="1" value="2" max="5" aria-label="Amount (to the nearest dollar)" />
                                            <button class="btn btn-sm px-2" data-type="plus">+</button>
                                        </div>
                                    </td>
                                    <td class="align-middle white-space-nowrap text-end pe-0 ps-3">
                                        <button class="btn btn-sm text-body-tertiary text-opacity-85 text-body-tertiary-hover me-2"><span class="fas fa-trash"></span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->

@endsection

@push('script')
@endpush