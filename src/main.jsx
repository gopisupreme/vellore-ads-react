import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import { Provider } from 'react-redux';
import App from './App.jsx';
import { getJSON } from './lib/api.js';
import { createStore } from './store/index.js';
import { installBehaviors } from './legacy/behaviors.js';
import { installForms } from './legacy/forms.js';
import './styles/app.css';

/*
 * On the server, app/index.php embeds the site data and the first page's
 * state in the HTML. On the Vite dev server they are fetched.
 */
async function start() {
  const embedded = window.__VELLORE_STATE__;
  const boot = embedded?.bootstrap ?? (await getJSON('bootstrap'));
  // the embedded state is always for the URL being loaded
  const initial = embedded
    ? { resolved: embedded.resolved, data: embedded.data, path: window.location.pathname + window.location.search }
    : null;

  const store = createStore({ boot, initialPage: initial });

  installBehaviors();
  installForms();

  createRoot(document.getElementById('root')).render(
    <StrictMode>
      <Provider store={store}>
        <BrowserRouter>
          <App />
        </BrowserRouter>
      </Provider>
    </StrictMode>,
  );
}

/** Instead of a blank page when the site data cannot be loaded (e.g. the database is down). */
function showStartupError(error) {
  const box = document.createElement('div');
  box.className = 'tw:mx-auto tw:my-16 tw:max-w-xl tw:rounded-lg tw:border tw:border-red-200 tw:bg-red-50 tw:p-6 tw:font-sans tw:text-gray-800';
  const title = document.createElement('h2');
  title.className = 'tw:mb-2 tw:text-xl tw:font-semibold tw:text-red-700';
  title.textContent = 'The site could not load its data';
  const detail = document.createElement('p');
  detail.className = 'tw:mb-4 tw:text-sm tw:break-words';
  detail.textContent = String(error?.message || error);
  const retry = document.createElement('button');
  retry.className = 'tw:rounded tw:bg-red-700 tw:px-4 tw:py-2 tw:text-white';
  retry.textContent = 'Try again';
  retry.addEventListener('click', () => window.location.reload());
  box.append(title, detail, retry);
  document.getElementById('root').replaceChildren(box);
}

start().catch((error) => {
  console.error(error);
  showStartupError(error);
});
