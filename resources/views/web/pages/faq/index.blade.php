@extends('web.layouts.app')

@section('content')
    <div class="faq-web-container">
        <h1 class="related-product-title text-555 mt-13 mb-5"><i class="zmdi zmdi-comments mr-4"></i> FAQ </h1>
        <div class="faq-wrapper">
            @foreach ($faqs as $faq)
                <div class="faq" onclick="viewFaq(this)">
                    <div class="question">
                        <span>{{ $faq->question }}</span>
                        <span><i class="zmdi zmdi-chevron-right"></i></span>
                    </div>
                    <div class="answer">
                        <span>{{ $faq->answer }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        function viewFaq(element) {
            const faqs = document.querySelectorAll('.faq-wrapper .faq');
            faqs.forEach((e) => {
                if( e.children[0].classList.contains('active') ) {
                    e.children[0].classList.remove('active');
                    e.children[1].classList.remove('active');
                }
            });

            element.children[0].classList.add('active');
            element.children[1].classList.add('active');
            element.children[1].classList.add('easeAnimation');
        }
    </script>
@endsection