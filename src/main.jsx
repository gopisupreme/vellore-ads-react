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
 * In production PHP (controllers/ReactApp.php) embeds the site data and the
 * first page's state in the HTML. On the Vite dev server they are fetched.
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

start();
