<ul class="md:flex-col md:min-w-full flex flex-col list-none">
              <!-- <li class="items-center">
                <a
                  href="./dashboard.html"
                  class="text-xs uppercase py-3 font-bold block text-pink-500 hover:text-pink-600"
                >
                  <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                  Dashboard
                </a>
              </li> -->

              <li class="items-center">
                <a
                  href="{{ route('home') }}"
                  class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('home') ? 'active' : '' }}"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M20 20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V11L1 11L11.3273 1.6115C11.7087 1.26475 12.2913 1.26475 12.6727 1.6115L23 11L20 11V20ZM11 13V19H13V13H11Z"></path></svg>
                  Acceuil
                </a>
              </li>

              <li class="items-center">
                <a
                 href="{{ route('dashboard') }}"
                  class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard') ? 'active' : '' }}"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M3 12C3 12.5523 3.44772 13 4 13H10C10.5523 13 11 12.5523 11 12V4C11 3.44772 10.5523 3 10 3H4C3.44772 3 3 3.44772 3 4V12ZM3 20C3 20.5523 3.44772 21 4 21H10C10.5523 21 11 20.5523 11 20V16C11 15.4477 10.5523 15 10 15H4C3.44772 15 3 15.4477 3 16V20ZM13 20C13 20.5523 13.4477 21 14 21H20C20.5523 21 21 20.5523 21 20V12C21 11.4477 20.5523 11 20 11H14C13.4477 11 13 11.4477 13 12V20ZM14 3C13.4477 3 13 3.44772 13 4V8C13 8.55228 13.4477 9 14 9H20C20.5523 9 21 8.55228 21 8V4C21 3.44772 20.5523 3 20 3H14Z"></path></svg>
                  Dashboard
                </a>
              </li>

              @role('admin|editor')
                <li class="items-center">
                    <a
                    href="{{ route('opportunities.index') }}"
                    class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/opportunities*') ? 'active' : '' }}"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M9.3349 11.5023L11.5049 11.5028C13.9902 11.5028 16.0049 13.5175 16.0049 16.0028H9.00388L9.00488 17.0028L17.0049 17.002V16.0028C17.0049 14.9204 16.6867 13.8997 16.1188 13.002L19.0049 13.0028C20.9972 13.0028 22.7173 14.1681 23.521 15.8542C21.1562 18.9748 17.3268 21.0028 13.0049 21.0028C10.2436 21.0028 7.90445 20.4122 6.00456 19.378L6.00592 10.0738C7.25147 10.2522 8.39122 10.7585 9.3349 11.5023ZM5.00488 19.0028C5.00488 19.5551 4.55717 20.0028 4.00488 20.0028H2.00488C1.4526 20.0028 1.00488 19.5551 1.00488 19.0028V10.0028C1.00488 9.45052 1.4526 9.00281 2.00488 9.00281H4.00488C4.55717 9.00281 5.00488 9.45052 5.00488 10.0028V19.0028ZM18.0049 5.00281C19.6617 5.00281 21.0049 6.34595 21.0049 8.00281C21.0049 9.65966 19.6617 11.0028 18.0049 11.0028C16.348 11.0028 15.0049 9.65966 15.0049 8.00281C15.0049 6.34595 16.348 5.00281 18.0049 5.00281ZM11.0049 2.00281C12.6617 2.00281 14.0049 3.34595 14.0049 5.00281C14.0049 6.65966 12.6617 8.00281 11.0049 8.00281C9.34803 8.00281 8.00488 6.65966 8.00488 5.00281C8.00488 3.34595 9.34803 2.00281 11.0049 2.00281Z"></path></svg>
                        Opportunites
                    </a>
                </li>
              @endrole


              <li class="items-center">
                    <a
                    href="{{ route('databanks.index') }}"
                    class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/databanks*') ? 'active' : '' }}"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2"  width="25"  viewBox="0 0 24 24" fill="#677B44"><path d="M17 7C13.5705 7 10.6449 9.15804 9.50734 12.1903L11.3805 12.8927C12.2337 10.6185 14.4278 9 17 9C17.6983 9 18.3687 9.11928 18.992 9.33857C21.3265 10.16 23 12.3846 23 15C23 18.3137 20.3137 21 17 21H7C3.68629 21 1 18.3137 1 15C1 12.3846 2.67346 10.16 5.00804 9.33857C5.0027 9.22639 5 9.11351 5 9C5 5.13401 8.13401 2 12 2C15.242 2 17.9693 4.20399 18.7652 7.19539C18.1973 7.0675 17.6065 7 17 7Z"></path></svg>
                        Databank
                    </a>
            </li>

            @role('admin')

            <li class="items-center">
                <a href="{{ route('users.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/users*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13Z"></path></svg>
                    <p>Utilisateurs</p>
                </a>
            </li>


            <li class="items-center">
                <a href="{{ route('secteur-activites.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/secteur-activites*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M12 19H14V6.00003L20.3939 8.74028C20.7616 8.89786 21 9.2594 21 9.65943V19H23V21H1V19H3V5.6499C3 5.25472 3.23273 4.89659 3.59386 4.73609L11.2969 1.31251C11.5493 1.20035 11.8448 1.314 11.9569 1.56634C11.9853 1.63027 12 1.69945 12 1.76941V19Z"></path></svg>
                    <p>Secteurs d'activites</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('secteur-activite-children.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/secteur-activite-children*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M21 20H23V22H1V20H3V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V20ZM19 20V4H5V20H19ZM8 11H11V13H8V11ZM8 7H11V9H8V7ZM8 15H11V17H8V15ZM13 15H16V17H13V15ZM13 11H16V13H13V11ZM13 7H16V9H13V7Z"></path></svg>
                    <p>Sous secteurs activites</p>
                </a>
            </li>


            <li class="items-center">
                <a href="{{ route('prescripteurs.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/prescripteurs*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M6 4V8H18V4H20.0066C20.5552 4 21 4.44495 21 4.9934V21.0066C21 21.5552 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5551 3 21.0066V4.9934C3 4.44476 3.44495 4 3.9934 4H6ZM8 2H16V6H8V2Z"></path></svg>
                    <p>Prescripteurs</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('parameters') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/parameters*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25"  viewBox="0 0 24 24" fill="#677B44"><path d="M2.13127 13.6308C1.9492 12.5349 1.95521 11.434 2.13216 10.3695C3.23337 10.3963 4.22374 9.86798 4.60865 8.93871C4.99357 8.00944 4.66685 6.93557 3.86926 6.17581C4.49685 5.29798 5.27105 4.51528 6.17471 3.86911C6.9345 4.66716 8.0087 4.99416 8.93822 4.60914C9.86774 4.22412 10.3961 3.23332 10.369 2.13176C11.4649 1.94969 12.5658 1.9557 13.6303 2.13265C13.6036 3.23385 14.1319 4.22422 15.0612 4.60914C15.9904 4.99406 17.0643 4.66733 17.8241 3.86975C18.7019 4.49734 19.4846 5.27153 20.1308 6.1752C19.3327 6.93499 19.0057 8.00919 19.3907 8.93871C19.7757 9.86823 20.7665 10.3966 21.8681 10.3695C22.0502 11.4654 22.0442 12.5663 21.8672 13.6308C20.766 13.6041 19.7756 14.1324 19.3907 15.0616C19.0058 15.9909 19.3325 17.0648 20.1301 17.8245C19.5025 18.7024 18.7283 19.4851 17.8247 20.1312C17.0649 19.3332 15.9907 19.0062 15.0612 19.3912C14.1316 19.7762 13.6033 20.767 13.6303 21.8686C12.5344 22.0507 11.4335 22.0447 10.3691 21.8677C10.3958 20.7665 9.86749 19.7761 8.93822 19.3912C8.00895 19.0063 6.93508 19.333 6.17532 20.1306C5.29749 19.503 4.51479 18.7288 3.86862 17.8252C4.66667 17.0654 4.99367 15.9912 4.60865 15.0616C4.22363 14.1321 3.23284 13.6038 2.13127 13.6308ZM11.9997 15.0002C13.6565 15.0002 14.9997 13.657 14.9997 12.0002C14.9997 10.3433 13.6565 9.00018 11.9997 9.00018C10.3428 9.00018 8.99969 10.3433 8.99969 12.0002C8.99969 13.657 10.3428 15.0002 11.9997 15.0002Z"></path></svg>
                    <p>Parametres</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('website-links.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/website-links*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M21 4V6H20L14 15V22H10V15L4 6H3V4H21Z"></path></svg>
                    <p>Scrappings</p>
                </a>
            </li>

            @endrole
            {{--
            <li class="items-center">
                <a href="{{ route('expertise-domains.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('expertiseDomains*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Expertise Domains</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('areaInterests.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('areaInterests*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Area Interests</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('permissions.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('permissions*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Permissions</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('roles.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('roles*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Roles</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('areaInterests.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('areaInterests*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Area Interests</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('attachments.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('attachments*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Attachments</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('files.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('files*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Files</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('opportunitySecteurChildrens.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('opportunitySecteurChildrens*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Opportunity Secteur Children</p>
                </a>
            </li>

            --}}

<!--
            <li class="items-center">
                <a href="{{ route('finances.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/finances*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M2 20H22V22H2V20ZM4 12H6V19H4V12ZM9 12H11V19H9V12ZM13 12H15V19H13V12ZM18 12H20V19H18V12ZM2 7L12 2L22 7V11H2V7ZM12 8C12.5523 8 13 7.55228 13 7C13 6.44772 12.5523 6 12 6C11.4477 6 11 6.44772 11 7C11 7.55228 11.4477 8 12 8Z"></path></svg>
                    <p>Finances</p>
                </a>
            </li> -->


            <li class="items-center">
                <a href="{{ route('type-finances.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/finances*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M2 20H22V22H2V20ZM4 12H6V19H4V12ZM9 12H11V19H9V12ZM13 12H15V19H13V12ZM18 12H20V19H18V12ZM2 7L12 2L22 7V11H2V7ZM12 8C12.5523 8 13 7.55228 13 7C13 6.44772 12.5523 6 12 6C11.4477 6 11 6.44772 11 7C11 7.55228 11.4477 8 12 8Z"></path></svg>
                    <p>Type Finances</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('acteur-finances.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/finances*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M2 20H22V22H2V20ZM4 12H6V19H4V12ZM9 12H11V19H9V12ZM13 12H15V19H13V12ZM18 12H20V19H18V12ZM2 7L12 2L22 7V11H2V7ZM12 8C12.5523 8 13 7.55228 13 7C13 6.44772 12.5523 6 12 6C11.4477 6 11 6.44772 11 7C11 7.55228 11.4477 8 12 8Z"></path></svg>
                    <p>Acteur Finances</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('services.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/services*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M21 8C22.1046 8 23 8.89543 23 10V14C23 15.1046 22.1046 16 21 16H19.9381C19.446 19.9463 16.0796 23 12 23V21C15.3137 21 18 18.3137 18 15V9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9V16H3C1.89543 16 1 15.1046 1 14V10C1 8.89543 1.89543 8 3 8H4.06189C4.55399 4.05369 7.92038 1 12 1C16.0796 1 19.446 4.05369 19.9381 8H21ZM7.75944 15.7849L8.81958 14.0887C9.74161 14.6662 10.8318 15 12 15C13.1682 15 14.2584 14.6662 15.1804 14.0887L16.2406 15.7849C15.0112 16.5549 13.5576 17 12 17C10.4424 17 8.98882 16.5549 7.75944 15.7849Z"></path></svg>
                    <p>Services</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('rate-tariffs.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('dashboard/rate-tariffs*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25" viewBox="0 0 24 24" fill="#677B44"><path d="M3 12H7V21H3V12ZM17 8H21V21H17V8ZM10 2H14V21H10V2Z"></path></svg>
                    <p>Taux & Tarifs</p>
                </a>
            </li>

            <li class="items-center">
                <a href="{{ route('abonnements.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('abonnements*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="25"  viewBox="0 0 24 24" fill="#677B44"><path d="M22.0049 9.99979V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V9.99979H22.0049ZM22.0049 7.99979H2.00488V3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979H21.0049C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V7.99979ZM15.0049 15.9998V17.9998H19.0049V15.9998H15.0049Z"></path></svg>
                    <p>Abonnements</p>
                </a>
            </li>

            {{-- <li class="items-center">
                <a href="{{ route('user-abonnements.index') }}" class="flex items-center text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500 {{ Request::is('userAbonnements*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>User Abonnements</p>
                </a>
            </li> --}}

    </ul>
