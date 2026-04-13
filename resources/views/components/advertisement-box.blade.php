<div class="ad-box {{ $class ?? '' }}" style="
        {{ $style ?? '' }};
        width: {{ $width ?? '100%' }};
        height: {{ $height ?? '250px' }};
    ">
    ADVERTISEMENT
</div>
<style>
    .ad-box {
    background-color: #f3f4f6;
    border: 1px solid #d1d5db;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
    padding: 10px 0;
    color: #6b7280;
}

/* 🔥 DARK MODE */
.ad-box.dark {
    background-color: #111;
    border: 1px solid #333;
    color: #aaa;
}
</style>