<section class="com-padd com-padd-redu-bot trending_top">
    <div class="icon_scroll" style="margin-top: 0px !important;">
        <div class="container com-title">
            <h2>Theatre's in <span>Vellore............</span></h2>
            <p style="margin-bottom: 35px !important;">"Stay updated with latest movie releases."</p>

            <div class="owl-carousel owl-theme">
                <?php foreach ($cinemas as $cinema): ?>
                    <div class="item">
                        <a class="location_block" title="<?= $cinema['title'] ?>" target="_blank"
                            href="<?= $cinema['url'] ?>">
                            <div class="image_block">
                                <a href="<?= $cinema['url'] ?>" class="text-decoration-none text-dark">
                                    <div class="image-container" style="background-image: url('<?= $cinema['img'] ?>');">
                                    </div>
                                    <p class="text-center"><?= $cinema['title'] ?></p>
                                </a>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="owl-carousel owl-theme">
                <!-- List Item -->
                <div class="item">
                    <a class="location_block" title="PVR CINEMAS" target="_blank" href="https://www.pvrcinemas.com/">
                        <div class="image_block">
                            <a href="https://www.pvrcinemas.com/" class="text-decoration-none text-dark">
                                <div class="image-container"
                                    style="border-radius: 5px !important;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(data:image/jpeg;base64,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);">
                                </div>
                                <p class="text-center" style="margin-top: 4px;">PVR CINEMAS</p>
                            </a>
                        </div>
                    </a>
                </div>
                <!-- End List Item -->
                <!-- List Item -->
                <div class="item">
                    <a class="location_block" title="VISHNU CINEMAS" target="_blank"
                        href="https://www.srivishnucinemas.in/">
                        <div class="image_block">
                            <a href="https://www.inoxmovies.com/" class="text-decoration-none text-dark">
                                <div class="image-container"
                                    style="border-radius: 5px !important;background-repeat: no-repeat;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(data:image/png;base64,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);">
                                </div>
                                <p class="text-center" style="margin-top: 4px;">INOX CINEMAS</p>
                            </a>
                        </div>
                    </a>
                </div>
                <!-- End List Item -->
                <!-- List Item -->
                <div class="item">
                    <a class="location_block" title="INOX CINEMAS" target="_blank" href="https://www.inoxmovies.com/">
                        <div class="image_block">
                            <a href="https://www.srivishnucinemas.in/" class="text-decoration-none text-dark">
                                <div class="image-container"
                                    style="border-radius: 5px !important;background-repeat: no-repeat;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(data:image/jpeg;base64,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);">
                                </div>
                                <p class="text-center" style="margin-top: 4px;">VISHNU CINEMAS</p>
                            </a>
                        </div>
                    </a>
                </div>
                <!-- End List Item -->

                <!-- List Item -->
                <div class="item">
                    <a class="location_block" title="ALANKAR CINEMAS" target="_blank" href="https://g.co/kgs/RQFHpcR">
                        <div class="image_block">
                            <a href="https://g.co/kgs/RQFHpcR" class="text-decoration-none text-dark">
                                <div class="image-container"
                                    style="border-radius: 5px !important;background-repeat: no-repeat;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(https://lh3.googleusercontent.com/p/AF1QipOnrkAJdCULzXxHg5BzPuPeH6rPcXKnufhrJLOW=s680-w680-h510);">
                                </div>
                                <p class="text-center" style="margin-top: 4px;">ALANKAR CINEMAS</p>
                            </a>
                        </div>
                    </a>
                </div>
                <!-- End List Item -->
                <!-- List Item -->
                <div class="item">
                    <a class="location_block" title="ASCARS CINEMAS" target="_blank" href="https://g.co/kgs/PQXKrLX">
                        <div class="image_block">
                            <a href="https://g.co/kgs/PQXKrLX" class="text-decoration-none text-dark">
                                <div class="image-container"
                                    style="border-radius: 5px !important;background-repeat: no-repeat;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(https://lh3.googleusercontent.com/p/AF1QipM9QXh-pDibGz-d8d0nhRRwkeMbLvyVGrm9Mc4l=s680-w680-h510);">
                                </div>
                                <p class="text-center" style="margin-top: 4px;">ASCARS CINEMAS</p>
                            </a>
                        </div>
                    </a>
                </div>
                <!-- End List Item -->
                <!-- List Item -->
                <div class="item">
                    <a class="location_block" title="GALAXY CINEMAS" target="_blank" href="https://g.co/kgs/Yk2RW5f">
                        <div class="image_block">
                            <a href="https://g.co/kgs/Yk2RW5f" class="text-decoration-none text-dark">
                                <div class="image-container"
                                    style="border-radius: 5px !important;background-repeat: no-repeat;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(https://lh3.googleusercontent.com/p/AF1QipMMzRdtAIiSpLyj8aqudkWDrmbaKE7KdIgVJBSJ=s680-w680-h510);">
                                </div>
                                <p class="text-center" style="margin-top: 4px;">GALAXY CINEMAS</p>
                            </a>
                        </div>
                    </a>
                </div>
                <!-- End List Item -->
                <!-- List Item -->
                <div class="item">
                    <a class="location_block" title="BLUE CINEMAS" target="_blank" href="https://g.co/kgs/a1RxYXE">
                        <div class="image_block">
                            <a href="https://g.co/kgs/a1RxYXE" class="text-decoration-none text-dark">
                                <div class="image-container"
                                    style="border-radius: 5px !important;background-repeat: no-repeat;background-position: center;background-size: cover;width: 100%;height:  100px !important;background-image: url(https://lh3.googleusercontent.com/p/AF1QipNcTNpbOIpP1Qa5CvzsgNmvnx4ohZcSBGFHfF2I=s680-w680-h510);">
                                </div>
                                <p class="text-center" style="margin-top: 4px;">BLUE CINEMAS</p>
                            </a>
                        </div>
                    </a>
                </div>
                <!-- End List Item -->
                <!-- List Item -->
                <div class="item">
                    <a class="location_block" title="VENUS CINEMAS" target="_blank" href="https://www.facebook.com/">
                        <div class="image_block">
                            <a href="https://g.co/kgs/RfZUUHH" class="text-decoration-none text-dark">
                                <div class="image-container"
                                    style="border-radius: 5px !important;background-repeat: no-repeat;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(https://lh3.googleusercontent.com/p/AF1QipPlavRhG_7b7Yb1Bs3rfgME1ZaGyasEKcKq6e0n=s680-w680-h510);">
                                </div>
                                <p class="text-center" style="margin-top: 4px;">VENUS CINEMAS</p>
                            </a>
                        </div>
                    </a>
                </div>
                <!-- End List Item -->
                <!-- List Item -->
                <div class="item">
                    <a class="location_block" title="VENUS CINEMAS" target="_blank" href="https://g.co/kgs/wgm3LKu">
                        <div class="image_block">
                            <a href="https://g.co/kgs/RfZUUHH" class="text-decoration-none text-dark">
                                <div class="image-container"
                                    style="border-radius: 8px !important;background-repeat: no-repeat;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(https://lh3.googleusercontent.com/p/AF1QipMp___FiTjvsmNyRA261CPc-0t7N69P3lR6Pl5l=s680-w680-h510);">
                                </div>
                                <p class="text-center" style="margin-top: 4px;">TIRUMALAI CINEMAS</p>
                            </a>
                        </div>
                    </a>
                </div>
                <!-- End List Item -->

            </div>
        </div>
    </div>

</section>