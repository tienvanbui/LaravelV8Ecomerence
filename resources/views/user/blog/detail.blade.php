@section('title')
  Blog Detail
@endsection
@include('common.layout.header')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92"
  style="background-image: url({{ asset('/images/user/bg-02.jpg') }});">
  <h2 class="ltext-105 cl0 txt-center">
    Blog
  </h2>
</section>


<!-- Content page -->
<!-- Content page -->
<section class="bg0 p-t-52 p-b-20">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-lg-9 p-b-80">
        <div class="p-r-45 p-r-0-lg">
          <!--  -->
          <div class="wrap-pic-w how-pos5-parent">
            <img src="{{ $blog->thumbnail }}" alt="IMG-BLOG">

            <div class="flex-col-c-m size-123 bg9 how-pos5">
              <span class="ltext-107 cl2 txt-center">
                {{ $blog->updated_at->format('d') }}
              </span>

              <span class="stext-109 cl3 txt-center">
                {{ $blog->updated_at->format('M,y') }}
              </span>
            </div>
          </div>

          <div class="p-t-32">
            <span class="flex-w flex-m stext-111 cl2 p-b-19">
              <span>
                <span class="cl4">By</span> :{{ $blog->user->username }}
                <span class="cl12 m-l-4 m-r-6">|</span>
              </span>

              <span>
                {{ $blog->updated_at->format('d M,y') }}
                <span class="cl12 m-l-4 m-r-6">|</span>
              </span>

              <span>
                @php
                  $stringTags = '';
                  foreach ($blog->tags as $tagItem) {
                      $stringTags .= "$tagItem->tags_name" . ',';
                  }
                  echo rtrim($stringTags, ',');
                @endphp
              </span>
            </span>

            <h4 class="ltext-109 cl2 p-b-28">
              {{ $blog->blog_name }}
            </h4>

            <p class="stext-117 cl6 p-b-26">
              {!! html_entity_decode($blog->blog_content) !!}
            </p>
          </div>

          <div class="flex-w flex-t p-t-16">
            <span class="size-216 stext-116 cl8 p-t-4">
              Tags
            </span>

            <div class="flex-w size-217">
              @foreach ($blog->tags as $item)
                <a href="{{ route('selectBlogByTag', [
    'tag' => $item,
]) }}"
                  class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                  {{ $item->tags_name }}
                </a>
              @endforeach
            </div>
          </div>

        </div>
      </div>

      <div class="col-md-4 col-lg-3 p-b-80">
        <div class="side-menu">
          <div class="p-t-55">
            <h4 class="mtext-112 cl2 p-b-33">
              Categories
            </h4>

            <ul>
              @foreach ($tags as $tag)
                <li class="bor18">
                  <a href="{{ route('selectBlogByTag', [
    'tag' => $tag,
]) }}"
                    class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                    {{ $tag->tags_name }}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
          <div class="p-t-50">
            <h4 class="mtext-112 cl2 p-b-27">
              Tags
            </h4>
            <div class="flex-w m-r--5">
              @foreach ($tags as $tag)
                <a href="{{ route('selectBlogByTag', [
    'tag' => $tag,
]) }}"
                  class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                  {{ $tag->tags_name }}
                </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('common.layout.footer')
