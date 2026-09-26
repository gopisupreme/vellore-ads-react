/** Lets sagas navigate with React Router: App registers the router's navigate(). */
let navigate = (to) => window.location.assign(to);

export function setNavigate(fn) {
  navigate = fn;
}

export const navigateTo = (to) => navigate(to);
