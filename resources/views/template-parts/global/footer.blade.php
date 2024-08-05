<div class="container" bis_skin_checked="1">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="{{route('divisions.index')}}" class="nav-link px-2 text-body-secondary ">Подразделения</a>
            </li>
            <li class="nav-item"><a href="{{route('coverall_types.index')}}" class="nav-link px-2 text-body-secondary">Виды
                    спецовок</a></li>
            <li class="nav-item"><a href="{{route('positions.index')}}" class="nav-link px-2 text-body-secondary">Должности</a>
            </li>
            <li class="nav-item"><a href="{{route('employers.index')}}" class="nav-link px-2 text-body-secondary">Работники</a>
            </li>
            <li class="nav-item"><a href="{{route('contracts.index')}}" class="nav-link px-2 text-body-secondary">Контракты</a>
            </li>
            <li class="nav-item"><a href="{{route('coveralls.index')}}" class="nav-link px-2 text-body-secondary">Спецовки</a>
            </li>
        </ul>
        <p class="text-center text-body-secondary">© 2024 Company, Inc</p>
    </footer>
</div>
@include('template-parts.global.footer-scripts')
</body>
</html>
