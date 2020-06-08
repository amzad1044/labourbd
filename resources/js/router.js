import Vue from 'vue';
import VueRouter from 'vue-router';

import TypeComponent from './components/TypeComponent';
import MainComponent from './components/MainComponent';
import AreaComponent from './components/AreaComponent';
import LabourComponent from './components/LabourComponent';
import ProfileComponent from './components/ProfileComponent';
import NewProfileComponent from './components/NewProfileComponent';
import OnworkingComponent from './components/OnworkingComponent';

Vue.use(VueRouter)

const routes = [
	{
		path: '/',
		redirect: '/main'
	},
	{
		path: '/main',
		component: MainComponent,
		name: 'main'
	},
	{
		path: '/type',
		component: TypeComponent,
		name: 'Type'
	},
	{
		path: '/area',
		component: AreaComponent,
		name: 'Area'
	},
	{
		path: '/labour',
		component: LabourComponent,
		name: 'Labour'
	},
	{
		path: '/profile',
		component: ProfileComponent,
		name: 'Profile'
	},
	{
		path: '/new-profile',
		component: NewProfileComponent,
		name: 'New-Profile'
	},
	{
		path: '/onworking',
		component: OnworkingComponent,
		name: 'onworking'
	}

]

export default new VueRouter({
	mode: 'history',
	routes
})
