@if (Auth::guard('customer')->check())
<div class="product-comment-box">
    <div class="parrent-comment-box">
        <div class="comment-box">
            <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Tambahkan komentar" name="comment"></textarea>
        </div>
        <div class="send-box">
            <button type="button" id="submit-comment">KIRIM</button>
        </div>
    </div>
</div>
@else
<div class="product-product-description-header">
    <div class="product-desc-wrapper">
        <a href="{{ url('/login') }}" class="text-decoration-none">
            <h5 class="ulasan-count mt-n10 text-pink">
                Masuk untuk berkomentar
            </h5>
        </a>
    </div>
</div>

@endif