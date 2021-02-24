@extends('layout')

@section('content')

    <div class="page-header header-filter" style="background-image: url({{url('assets/img/photo_main.jpg')}});">
        <div class="container" style="padding-top: 15vh !important;">
        </div>
    </div>

    <div class="wrapper" style="margin-top: 55px;">

        <div class="main main-raised" style="z-index: 1">

            <!--   Error notification container (hidden by default  -->
            <div class="alert alert-danger hide">
                <div class="container">
                    <div class="alert-icon">
                        <i class="material-icons">error_outline</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <b> تنبيه خطأ :</b>حدث خطأ اثناء معالجة الطلب , الرجاء المحاولة مرة أخرى ..
                </div>
            </div>
            <!--  end  Error notification container   -->

            <div class="container">
                <div class="section text-center">
                    <h2 class="title">فريق العمل </h2>

                    <div class="team">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="team-player">
                                    <img src="../assets/img/zaher1.jpg" alt="Thumbnail Image"
                                         class="img-raised img-circle">
                                    <h4 class="title">زاهر ططري <br/>
                                        <small class="text-muted">FrontEND webDesigner</small>
                                    </h4>
                                    <p class="description"> مصمم وطالب في كلية الهندسة المعلوماتية - سنة 4 </p>
                                    <a href="#pablo" class="btn btn-simple btn-just-icon"><i
                                                class="fa fa-twitter"></i></a>
                                    <a href="#pablo" class="btn btn-simple btn-just-icon"><i
                                                class="fa fa-instagram"></i></a>
                                    <a href="https://www.facebook.com/zaher.tatai"
                                       class="btn btn-simple btn-just-icon btn-default"><i
                                                class="fa fa-facebook-square"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="team-player">
                                    <img src="../assets/img/yahianajjar.jpg" alt="Thumbnail Image"
                                         class="img-raised img-circle">
                                    <h4 class="title">أ.د. يحيى نجار <br/>
                                        <small class="text-muted">proffisor</small>
                                    </h4>
                                    <p class="description"> الدكتور المشرف عميد كلية الهندسة المعلوماتية </p>
                                    <a href="#pablo" class="btn btn-simple btn-just-icon"><i
                                                class="fa fa-twitter"></i></a>
                                    <a href="#pablo" class="btn btn-simple btn-just-icon"><i
                                                class="fa fa-linkedin"></i></a>
                                    <a href="https://www.facebook.com/yahya.najjar.31"
                                       class="btn btn-simple btn-just-icon btn-default"><i
                                                class="fa fa-facebook-square"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="team-player">
                                    <img src="../assets/img/ahmad.jpg" alt="Thumbnail Image"
                                         class="img-raised img-circle">
                                    <h4 class="title">أحمد مصابني <br/>
                                        <small class="text-muted">BackEND webDesigner</small>
                                    </h4>
                                    <p> مطور ويب وطالب في كلية الهندسة المعلوماتية - سنة 4</p>
                                    <a href="https://www.facebook.com/ahmad.masabni"
                                       class="btn btn-simple btn-just-icon btn-default"><i
                                                class="fa fa-facebook-square"></i></a>
                                    <a href="#pablo" class="btn btn-simple btn-just-icon"><i
                                                class="fa fa-youtube-play"></i></a>
                                    <a href="#pablo" class="btn btn-simple btn-just-icon btn-default"><i
                                                class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
        </div>


    </div>
    <div class="hide drawing" id="drawing">


    </div>

@endsection
