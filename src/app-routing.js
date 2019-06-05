/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */
 
import { RouterModule } from 'Modules/router';
import { AppComponent } from 'Components/app.component';
import { NotFoundComponent } from 'Components/not-found/not-found.component';
import { AuthComponent } from 'Components/auth/auth.component';
import { LoginComponent } from 'Components/auth/login/login.component';
import { RegisterComponent } from 'Components/auth/register/register.component';
import { ProfileComponent } from 'Components/profile/profile.component';

const routes = [
  {
    path: '/',
    component: AppComponent
  },
  {
    path: 'auth',
    component: AuthComponent,
    redirectTo: 'auth/login',
    children: [
      {
        path: 'login',
        component: LoginComponent
      },
      {
        path: 'register',
        component: RegisterComponent
      }
    ]
  },
  {
    path: 'profile',
    component: ProfileComponent
  },
  {
    path: '**',
    component: NotFoundComponent
  }
];

export const router = new RouterModule(routes);