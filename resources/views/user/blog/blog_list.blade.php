@section('title')
  Blog
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
<section class="bg0 p-t-62 p-b-60">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-lg-9 p-b-80">
        <div class="p-r-45 p-r-0-lg">
          <!-- item blog -->
          @foreach ($blogs as $blogItem)
            @foreach ($blogItem as $item)
              <div class="p-b-63">

                <a href="{{ route('detail-blog', [
    'blog' => $item->id,
]) }}"
                  class="hov-img0 how-pos5-parent">
                  <img src="{{ $item->thumbnail }}" alt="img-blog">

                  <div class="flex-col-c-m size-123 bg9 how-pos5">
                    <span class="ltext-107 cl2 txt-center">
                      {{$item->updated_at->format('d')}}
                    </span>

                    <span class="stext-109 cl3 txt-center">
                      {{$item->updated_at->format('M y')}}
                    </span>
                  </div>
                </a>

                <div class="p-t-32">
                  <h4 class="p-b-15">
                    <a href="{{ route('detail-blog', [
    'blog' => $item->id,
]) }}"
                      class="ltext-108 cl2 hov-cl1 trans-04">
                      {{ $item->blog_name }}
                    </a>
                  </h4>

                  <p class="stext-117 cl6 overflow-hidden">
                    {!! substr ($item->blog_content,0,300).'....'!!}
                  </p>

                  <div class="flex-w flex-sb-m p-t-18">
                    <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
                      <span>
                        <span class="cl4">By</span>: {{ $item->user->username }}
                        <span class="cl12 m-l-4 m-r-6">{!! '|' !!}</span>
                      </span>

                      <span>
                        @php
						$stringTags = '';
                          foreach ($item->tags as $tagItem) {
                              $stringTags .= "$tagItem->tags_name".',';
                          }
                          echo rtrim($stringTags, ',');
                        @endphp

                      </span>
                    </span>

                    <a href="{{ route('detail-blog', [
    'blog' => $item->id,
]) }}"
                      class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                      Continue Reading

                      <i class="fa fa-long-arrow-right m-l-9"></i>
                    </a>
                  </div>
                </div>


              </div>
            @endforeach

          @endforeach

          <!-- Pagination -->
          <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
            {{ $blogs->links() }}
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
