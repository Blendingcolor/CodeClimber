/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode:'class',
	theme: {
		extend: {
			fontFamily: {
				'title': ['Ubuntu', 'sans-serif'],
				'text': ['Inter', 'sans-serif'],
				'button': ['Lato', 'sans-serif'],
				'crud':['Roboto Mono', 'monospace']
			},
			colors:{
				'jsColor': ['rgb(223,223,59)'],
				'tableColor': ['#8C8C8D'],
				'webColor': ['#FFFF44']
			},
			screens: {
				'ss': {'max': '300px'},
				'us': {'max': '400px'},
				'sm': {'max': '500px'},
				'md': {'max': '768px'},
				'lg': {'max': '950px'},
				'xl': {'max': '1280px'},
			  }
		},
	},
  plugins: [],
}

