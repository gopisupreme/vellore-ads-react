import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import App from './App.jsx';
import { getJSON } from './lib/api.js';
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

  installBehaviors();
  installForms();

  createRoot(document.getElementById('root')).render(
    <StrictMode>
      <BrowserRouter>
        <App boot={boot} initial={initial} />
      </BrowserRouter>
    </StrictMode>,
  );
}

start();
