<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="https://www.gtis.mx" target="_blank">{{ __('GTIS') }}</a>
                    </li>
                
                </ul>
            </nav>
            <div class="credits ml-auto">
                <span class="copyright">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>{{ __(' Software Desarrollado por ') }} <br><a class="@if(Auth::guest()) text-white @endif" href="https://www.gtis.mx" target="_blank">{{ __('Grupo Tecnológico Integrador del Sureste S.A. de C.V.') }}</a>
                </span>
            </div>
        </div>
    </div>
</footer>