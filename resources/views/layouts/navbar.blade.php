<nav class="absolute top-0 left-0 w-full z-10 bg-[#677B44] md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
          <div
            class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
          >
            <a
              class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
              href="./index.html"
              >Admin</a
            >
            <ul
              class="flex-col md:flex-row list-none items-center hidden md:flex"
            >
              <a
                class="text-blueGray-500 block"
                onclick="openDropdown(event,'user-dropdown')"
              >
                <div class="items-center flex">
                  <span
                    class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
                    ><img
                      alt="..."
                      class="w-full rounded-full align-middle border-none shadow-lg"
                      src="{{asset('images/user.png')}}"
                  /></span>
                </div>
              </a>
              <div
                class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                id="user-dropdown"
              >
                <a

                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                  >Profile</a
                >
                    <form method="POST" action="{{ route('logout') }}">
                                @csrf
                        <button class="text-sm py-2 px-4 font-normal block whitespace-nowrap bg-transparent text-blueGray-700">Déconnexion</button>
                    </form>
              </div>
            </ul>
          </div>
</nav>
