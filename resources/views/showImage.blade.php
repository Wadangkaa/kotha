@extends('layouts.main')

<style>
    #gallery {
        padding-top: 40px;

        @media screen and (min-width: 991px) {
            padding: 60px 30px 0 30px;
        }
    }

    .img-wrapper {
        position: relative;
        margin-top: 15px;
    }

    .img-overlay {
        background: rgba(0, 0, 0, 0.7);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
    }

    #overlay {
        background: rgba(0, 0, 0, 0.7);
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
        // Removes blue highlight
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    #nextButton {
        color: #fff;
        font-size: 2em;
        transition: opacity 0.8s;
    }

    #prevButton {
        color: #fff;
        font-size: 2em;
        transition: opacity 0.8s;
    }

    #exitButton {
        color: #fff;
        font-size: 2em;
        transition: opacity 0.8s;
        position: absolute;
        top: 15px;
        right: 15px;
    }
</style>

@section('main-section')
    <section id="gallery">
        <div class="container pt-5">
            <div id="image-gallery">
                <div class="row">
                    @foreach ($images as $image)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                            <div class="img-wrapper">
                                <img src="{{ asset('storage/uploads/' . $image->image_url) }}" class="img-responsive">
                                <div class="img-overlay">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!-- End row -->
            </div><!-- End image gallery -->
        </div><!-- End container -->
    </section>
@endsection

</body>

</html>
