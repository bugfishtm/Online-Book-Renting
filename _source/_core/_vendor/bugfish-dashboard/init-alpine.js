/* 	__________ ____ ___  ___________________.___  _________ ___ ___  
	\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
	 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
	 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
	 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
			\/                 \/     \/                \/       \/  	
						www.bugfish.eu
						
	Bugfish Fast PHP Page Framework
	Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
	
function data() {
  function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
  }

  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      this.dark = !this.dark
      setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    isLangMenuOpen: false,
    toggleLangMenu() {
      this.isLangMenuOpen = !this.isLangMenuOpen
    },
    closeLangMenu() {
      this.isLangMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    isPagesMenuOpen1: false,
    togglePagesMenu1() {
      this.isPagesMenuOpen1 = !this.isPagesMenuOpen1
    },
    isPagesMenuOpen2: false,
    togglePagesMenu2() {
      this.isPagesMenuOpen2 = !this.isPagesMenuOpen2
    },
    isPagesMenuOpen3: false,
    togglePagesMenu3() {
      this.isPagesMenuOpen3 = !this.isPagesMenuOpen3
    },
    isPagesMenuOpen4: false,
    togglePagesMenu4() {
      this.isPagesMenuOpen4 = !this.isPagesMenuOpen4
    },
    isPagesMenuOpen5: false,
    togglePagesMenu5() {
      this.isPagesMenuOpen5 = !this.isPagesMenuOpen5
    },
    isPagesMenuOpen6: false,
    togglePagesMenu6() {
      this.isPagesMenuOpen6 = !this.isPagesMenuOpen6
    },
    isPagesMenuOpen7: false,
    togglePagesMenu7() {
      this.isPagesMenuOpen7 = !this.isPagesMenuOpen7
    },
    isPagesMenuOpen8: false,
    togglePagesMenu8() {
      this.isPagesMenuOpen7 = !this.isPagesMenuOpen7
    },
    isPagesMenuOpen8: false,
    togglePagesMenu8() {
      this.isPagesMenuOpen8 = !this.isPagesMenuOpen8
    },
    isPagesMenuOpen9: false,
    togglePagesMenu9() {
      this.isPagesMenuOpen9 = !this.isPagesMenuOpen9
    },
    isPagesMenuOpen10: false,
    togglePagesMenu10() {
      this.isPagesMenuOpen10 = !this.isPagesMenuOpen10
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
  }
}
