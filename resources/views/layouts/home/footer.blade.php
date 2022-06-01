<footer>
    <div id="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h2>60 Day Challenge</h2>
                    <p class="mt-4">60 Day Challenge merupakan platform gratis untuk mencoba sesuatu selama 60
                        hari
                        tantangan.</p>
                    <div class="row mt-4">
                        <div class="col text-light">
                            <a href="https://linkedin.com/in/riezkan-aprianda-firmansyah-a080291b3" target="_blank"><i
                                    class="mx-2 fab fa-linkedin fa-2x"></i></a>
                            <a href="https://instagram.com/_rizkanfirmansyah" target="_blank"><i
                                    class="mx-2 fab fa-instagram fa-2x"></i></a>
                            <a href="https://fb.com/riezkanfirmansyah" target="_blank"><i
                                    class="mx-2 fab fa-facebook fa-2x"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h4>Services</h4>
                    <a href="#">Contact Us</a>
                    <a href="#">About Us</a>
                    <a href="#">Privacy & Policy</a>
                </div>
                <div class="col-lg-2">
                    <h4>Challenge</h4>
                    @foreach ($challenges as $item)
                        <a href="c?title={{ $item->slug }}&id={{ $item->id }}">{{$item->title}}</a>
                    @endforeach
                </div>
                <div class="col-lg-2">
                    <h4>Other</h4>
                    <a href="#">Contribute</a>
                    <a href="#">Tentang Kami</a>
                    <a href="#"></a>
                </div>
            </div>
        </div>
    </div>
    <div id="secondary-footer">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-between">
                    <span>Copyright &copy; 2022 60 Day Challenge All Right Reserved</span>
                    <span>Created by <a href="https://linkedin.com/in/riezkan-aprianda-firmansyah-a080291b3"
                            target="_blank">Rizkan Firmansyah</a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
