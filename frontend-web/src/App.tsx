import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Login from './pages/Login';
//import Registration from './pages/Registration';
//import Role from './pages/Role';
import Dashboard from './pages/Dashboard';
//import Pbn_entry_form from './pages/components/quedan_tracking/Pbn_entry_form';
function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/dashboard" element={<Dashboard />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
