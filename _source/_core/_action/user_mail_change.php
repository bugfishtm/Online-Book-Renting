<?php
	/* 
		 ____  __  __  ___  ____  ____  ___  _   _ 
		(  _ \(  )(  )/ __)( ___)(_  _)/ __)( )_( )
		 ) _ < )(__)(( (_-. )__)  _)(_ \__ \ ) _ ( 
		(____/(______)\___/(__)  (____)(___/(_) (_) www.bugfish.eu
				 ___ _   _ ___ _____ ___ ___ ___ ___ _  _ 
				/ __| | | |_ _|_   _| __| __|_ _/ __| || |
				\__ \ |_| || |  | | | _|| _| | |\__ \ __ |
				|___/\___/|___| |_| |___|_| |___|___/_||_|
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
		
	*/ if(file_exists("../../settings.php")) { require_once("../../settings.php"); } else { @http_response_code(404); Header("Location: ../"); exit(); } 

	$favi_code = '<link rel="icon" href="data:image/x-icon;base64,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zI3c1cyN3dXMjd3VzI3d1cyN3dXMjd3VzI3d1cyN3dXNjd3UzI3d1c2N3dXMjd7XzIvd2M1h4+PGCQAAAAC4raMZtqya19DHu//d1s3/3dbM/93WzP/d1sz/3dbM/93WzP/c1sz/3dbN/93WzP/d1sz/3dbM/9zWzP/c1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93XzP/d1sz/3dbM/93XzP/d18z/3dbM/9DHu/+3rJvXuK2jGc/Iu6a3rJv/tqua/9DHu//d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/c1sz/3dbN/93WzP/Qx7v/tqua/7esm//PyLum3NbM89PLv/+3rJv/tqua/9DHu//d1sz/3dbM/93WzP/d1sz/3dfM/93WzP/d1sz/3dfM/93XzP/d1sz/3NbM/93WzP/c1sz/3dbM/93WzP/d1sz/3dbN/93WzP/d1s3/3dbM/93WzP/d1sz/0Me7/7aqmv+3rJv/08u//9zWzPPd1sz/3dbM/9PLv/+3rJv/tqua/9DHu//d1sz/3dfM/93WzP/c1sz/3dbM/93WzP/d1sz/3NbM/93WzP/b1Mr/29TK/93WzP/d18z/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9DHu/+3qpr/t6yb/9PLv//d1sz/3dbM/93WzP/d1sz/3dbM/9PLv/+3rJv/tqua/9DHu//d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/Ryb3/vLOj/7Wqmf+1q5n/vrOk/9PLv//d1sz/3dbM/93WzP/d1sz/3dbM/9zWzP/Qx7v/tqqa/7etm//Ty7//3dbN/93WzP/c1sz/3dbM/93WzP/d1sz/3dbM/9PKv/+3rJv/tqua/9DHu//d1sz/3dbM/93WzP/d1sz/zcS3/7Wqmf+1qpn/taqY/7Wqmf+1qpn/taua/87Guv/d1sz/3dbM/93WzP/d1sz/0Me7/7armv+3rJv/08u//93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1s3/3dbM/9PLv/+3rJr/tqub/9DGu//d1sz/3dbM/83Ftv+1qpn/taqZ/8W8rv/WzsP/1s7D/8W8r/+1q5j/taqZ/8/Guf/d1sz/3dbM/9DHu/+2q5r/t6yb/9PLv//c1sz/3NbN/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbN/9PLv/+3rJv/tqua/9DHu//NxLf/taqZ/7Wqmf/Wz8P/7ejh/+3o4f/t6OH/7ejh/9bPw/+0q5n/tKqZ/8/Guf/Qx7v/t6ua/7esm//Tyr//3dbM/93Wzf/d1sz/3dbN/93Xzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9PLv/+3rJv/tKub/7Srmf+1qpn/18/E/+3o4f/t6OH/7ejh/+3o4f/s6OH/7ejh/9fOxP+1qpn/taqZ/7ermv+3rJv/08u+/93XzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/8a9r/+1qpn/tKuZ/9bPxP/t6OD/7ejh/+zo4P/t6OH/7ejg/+3o4f/t6OH/7ejh/9bPxP+1qpn/tauZ/8e+sP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/NxLf/taqZ/7Wqmf/Wz8T/7ejh/+3o4f/t6OH/7ejh/+3o4f/s6OH/7ejh/+zp4f/t6OH/7ejh/9fPxP+1qpj/taqZ/8/Fuf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/zcS3/7Wqmf+1qpn/1s/E/+3o4f/t6OH/7ejh/+zo4f/t6OH/7enh/+3o4f/s6OH/7ejh/+3o4f/t6OH/7enh/9bPxP+0qpn/taqY/87Fuf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/c1sz/3dbM/8zEtv+0qpn/taqZ/9bPxP/t6OH/7ejh/+3o4f/t6OH/7enh/+3p4f/t6eH/7ejh/+3o4f/t6eD/7Ojh/+zo4f/t6OH/7ejh/9bPxP+1qpn/taqZ/83FuP/c18z/3dfM/93WzP/d1sz/3dbM/9zWzP/d1s3/3dfM/93WzP/MxLb/taqZ/7Wqmf/WzsT/7ejh/+3o4f/t6OH/7ejg/+3o4f/t6OH/7ejh/+3o4f/s6eH/7enh/+3o4f/t6OD/7enh/+3o4f/s6OH/7ejg/9fPxP+1qpn/tKqY/83FuP/d1sz/3dbM/93XzP/d18z/3dbM/93WzP/d1sz/zMS2/7WrmP+1qpn/1s/E/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9bPxP+1qpn/taqZ/83FuP/c1sz/3NbM/93WzP/d1sz/3dbM/8zFt/+0qpn/taqZ/9bPxP/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6eH/7enh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/s6OH/7ejh/+3o4f/t6OH/7ejh/9bPxP+1qpn/taqZ/83EuP/d1sz/3dbM/93WzP/MxLb/taqZ/7Wrmf/Wz8T/7ejg/+zp4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7Ojh/+3p4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9bPxP+1qpn/taqZ/83Et//d1sz/zMS2/7Wqmf+1qpn/1s/F/+3o4f/t6eD/7ejh/+3o4f/t6OD/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3p4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9bPxP+1qpj/taqZ/8zEt/+1qpn/taqZ/9bPxP/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/9bPxP+1qpn/taqZ/7armvXXz8T/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OD/7enh/+3o4f/t6OH/7enh/+3o4f/t6OH/7ejh/+zo4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7eng/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7Ojh/9bPxP+2q5v02tLJqu3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7enh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7enh/+3o4f/t6OH/7enh/+3o4f/t6OH/7ejh/9vTyKjr4uIa7efg2e3o4P/t6OH/7ejh/+3o4f/t6OH/7enh/+zo4f/t6eH/7ejh/+3o4f/t6OH/7enh/+3o4f/t6OH/7ejh/+3p4f/t6eH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+zp4f/t6OH/7ejh/+3o4f/s5+DY4uLYGgAAAADo0dEL6+beZezm3pDq5d6T6uXek+rl3pPq5d6T6uXek+rl3pPq5d6T6uXek+rl3pPq5N6T6+Xek+rl3pPq5d6T6uXek+rl3pPq5d+T6uXek+vl3pPq5d6T6uXek+rl3pPr5d6T6uXek+rl3pPs5t+Q6+beZebm5goAAAAAAAAAAAABAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAABAQAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAABAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKAAAADAAAABgAAAAAQAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAQAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAQAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/8zMBdzTyh3b1swy3NTMQdzVzULc1c1C3NXNQtzVzULc1c1C3NXNQtzVzULc1c1C3NXNQtzVzULc1c1C3NXNQtzVzULc1M1C3NXNQtzVzULc1c1C3NXNQtzVzELc1c1C3NXNQtzVzULc1c1C3NXNQtzVzULc1M1C3NXNQtzVzULc1c1C3NXNQtzVzULc1c1C3NXNQtzVzULc1c1C3NXNQtzUzEHb1swy3NPKHf/MzAUAAAAAAAAAAAAAAAC6sZ0avbOjgNrSx9Pd1sz53dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz52tLH07+zpX+6sZ0aAAAAALa2pA63rZuctqqa+sG3qP/a0sj/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/a0sj/wbeo/7arm/m3rJuctrakDs/JvFC9saL6taqZ/7Wqmf/Euqv/2tLI/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d18z/3dbM/9rSxv/Euqv/taqZ/7Wqmf+9saL6z8m8UN3Vy7zTy7//vLGh/7Wqmf+2qpr/xLqs/9rSyP/d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/2tLI/8S6qv+2q5r/taqZ/7yxoP/Ty7//3dXLvN3VzPXd1sz/1c7C/7qvn/+1qpn/taqa/8G3qf/a0sj/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3NbM/93WzP/a0sj/wbep/7Wqmv+1qpn/uq+f/9XOwv/d1sz/3NXM9d3WzP/d1sz/3dbM/9XOw/+8saH/taqZ/7Wqmf/Euqz/2tLI/93WzP/d1sz/3NbM/93WzP/d18z/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3NXL/9zVy//d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/9rSyP/Euqz/taqZ/7Wqmf+8saH/1c7D/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/Ty7//vLGh/7Wqmf+2q5r/xLqs/9rSyP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93Wzf/d1sz/3dXL/9PLv//LwrX/x76w/8e+sP/Lwrb/1MzB/93WzP/d1sz/3NbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/29LI/8S6rP+2q5r/taqZ/7yxof/Tyr//3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3NbM/93WzP/d1sz/1c7C/7qvn/+1qpn/taqa/8G3qf/a0sj/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/Z0sf/w7mr/7iunP+2q5r/taqZ/7Wqmf+2q5r/ua6e/8W8rf/a08j/3dbM/93WzP/d1sz/3dbM/93Wzf/d1sz/3dbM/93WzP/a0sj/wLep/7Wqmv+1qpn/uq+f/9XOwv/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9XOwv+8saH/taqZ/7Wqmv/Eu6z/2tLI/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9jRxv/Bt6j/taqZ/7Wqmf+1qpn/taqZ/7Wqmf+1qpn/taqZ/7Wqmf/Cu6v/2dLH/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/9rSyf/Euqz/taqa/7Wqmf+8saH/1c7C/93Wzf/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93Wzf/d1sz/3dbM/93WzP/Ty7//vLGh/7Wqmf+2q5r/xLqs/9rSyP/d1sz/3dbM/93WzP/d1sz/2NDF/8G3qP+1qpn/taqZ/7Wqmf+2rJv/u7Gh/7uxoP+2rZv/taqZ/7WqmP+1qpn/wrmq/9nRxv/d1sz/3dbM/93WzP/d1sz/2tLI/8S6rP+2q5r/taqZ/7yxof/Ty7//3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/1c7C/7qvn/+1qpn/taqa/8G3qf/a0sj/3dbM/93WzP/Y0MX/vrSl/7Wqmf+1qpn/taqZ/8jAs//g2ND/5uDX/+Xg1//f2dD/ycCz/7Wqmf+1qpn/taqZ/8C2pv/Z0cb/3dbM/93WzP/a0sj/wbep/7Wqmv+1qpn/uq+f/9XOw//d1sz/3dbM/93WzP/d1sz/3dbM/93Wzf/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9XOwv+8saH/tKqZ/7Wqmv/Euqz/2tLI/9jRxv/Bt6j/taqZ/7Wqmf+5r57/19DE/+3o4f/t6eH/7ejh/+3o4f/t6eH/7ejh/9fQxf+5r57/tKqZ/7Wqmf/Cuar/2dLH/9rSyP/Euqz/taqa/7WqmP+8saH/1M7C/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/Ty7//vbGh/7Wqmf+2q5r/w7qs/8G3qf+1qpn/taqZ/7mvnv/Xz8T/6+bf/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+vm3//Xz8T/ua+e/7Wqmf+1qpn/wrmq/8S6rP+2q5r/taqZ/7yxof/Ty7//3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3NbM/93WzP/d1sz/3dbM/93Wzf/d1sz/1c7D/7qvn/+1qpn/taqZ/7Wqmf+1qpn/tqua/9nSx//r5t//7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/r5t//2dLH/7armv+1qpn/taqZ/7Wqmf+1qpn/uq+f/9XOw//d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/9PLv/+3rZz/taqZ/7Wqmf+5r57/2NLH/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/9jSx/+5rp7/taqZ/7Wqmf+4rZz/1MvA/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/2NDF/8G3qP+1q5n/taqZ/7mvnv/Xz8T/6+bf/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+vm3//Wz8T/ua+e/7Wqmf+1qpn/wrip/9jRxv/d1sz/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/Y0cX/vrSl/7WqmP+1qpn/tqua/9nSx//r5t//7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/r5t//2dLH/7armv+1qpn/tKqZ/7+2pv/Y0cb/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9jRxv/Bt6j/taqZ/7Wqmf+5r57/2dLH/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/9nSx/+5r57/tKqZ/7Wqmf/BuKn/2dHH/93WzP/d1sz/3dbM/93Wzf/d18z/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/19DF/8G3qP+1qpn/taqZ/7mvn//Wz8T/6+bf/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7Ojh/+3o4f/t6OH/7ejh/+vm3//Wz8T/ua6e/7WqmP+1qpn/wbep/9jRxv/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3NbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/Y0MX/vrSl/7Wqmf+1qpn/tqua/9nSx//r5t//7ejh/+3o4f/t6OH/7Ojh/+3o4P/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/r59//2NHH/7armv+1qpn/tKqZ/7+1pv/Y0cb/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9jRxv/Btqj/taqZ/7Wqmf+5rp7/2dLH/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9jRx/+5rp7/taqZ/7WqmP/Bt6j/2dHG/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d18z/3dbM/93WzP/d1sz/19DE/8C3qP+1qpn/taqZ/7munv/Wz8T/6+bf/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+vm3//Wz8T/ua6e/7Wqmf+1qpn/wbeo/9jRxv/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/93WzP/X0cT/vrSk/7Wqmf+1qpn/tqua/9jSx//r5t//7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/r5t//2NHH/7armv+1qpn/taqZ/7+1pf/Y0Mb/3dbM/93WzP/d1sz/3dbM/93WzP/d1sz/3dbM/9jRxv/At6j/taqZ/7Wqmf+5rp7/2NHH/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/9jRx/+5rp7/tKqZ/7Wqmf/Bt6j/2dHG/93Wzf/d1sz/3dbM/93WzP/d1sz/19DE/8C3p/+1qpn/taqZ/7munv/Wz8T/6+bf/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+vm3//Wz8T/ua6e/7Wqmf+1qpn/wbeo/9jRxf/d1sz/3NbM/93WzP/X0MT/vrSk/7Wqmf+1qpn/tqua/9jRx//r5t//7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/r5t//2NHH/7armv+1qpn/taqZ/7+0pf/Y0MX/3dbM/9jRxf/At6f/taqZ/7Wqmf+5rp7/2NHH/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9jRx/+5rp7/taqZ/7Wqmf/Bt6j/2NHG/8C3p/+1qpn/taqZ/7munv/Wz8T/6+bf/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+vm3//Wz8T/uK6e/7WqmP+1qpn/wbeo/7Wqmf+1qpn/tqua/9jRx//r5t//7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6eH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/r5t//2NHH/7armv+1qpn/taqZ/7Wqmfm5rp7/2NHH/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9jRx/+5r57/t6ua97uwoMLWz8T/6+bf/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+vm3//Wz8T/vLKiv9vVzFXs5t777ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/r5t373dTLU+7d3Q/s5d+f7Ojg+u3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4Prq5d2e7e3bDgAAAADs4+Mb7Obeg+zn4Nft6OH77ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH77Ofg1+vm4ILj49kbAAAAAAAAAAAAAAAA1NTUBu7m3R7s49425uDZSufg2kvn4NpL5+DaS+fg2kvn4NpL5+DaS+fg2kvn4dpL5+DaS+fg2kvn4NpL5+DaS+fg2kvn4NpL5uDaS+fg2kvn4NpL5+DaS+fg2kvn4dpL5+DaS+fg2kvn4NpL5+DaS+fg2kvn4NpL5+DaS+fg2kvn4NpL5+DaS+fg2kvn4NpL5+DaS+fg2kvn4NpL5+DaS+fg2Urs49425ubdHtTU1AYAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAQAAAAAAAAAAAQAAAAAAAAAAAAAAAQAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==">';

	// Output Empty Array if Current Website Error
	if(defined("_HIVE_CRIT_ER_")) {
		hive__default_volt_header($object, "Error", $favi_code, "dark");
		?>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
							The site module encountered an error, so you cannot view this page at the moment.
                        </div>
                    </div>
                </div>
            </div>
        </section>					
		<?php 
		hive__default_volt_footer($object, "");
		exit();
	}
	
	// Check for Activation of this Action Section and IP Bans
	if($object["ipbl"]->blocked()) { 
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
			hive__default_volt_header($object, "Error", $favi_code, "dark");
			?>
			<section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
				<div class="container mb-5">
					<div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
						<div class="col-12 d-flex align-items-center justify-content-center">
							<div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
								Your IP-Adress is currently blocked!<br />Please try again later or contact our support team.
								<br /><br /><a href="../../">Back to Home</a>
							</div>
						</div>
					</div>
				</div>
			</section>					
			<?php 
			hive__default_volt_footer($object, "");
			exit();
	}	
	if(defined("_HIVE_ACTION_MAILCHANGE_")) { 
		if(!_HIVE_ACTION_MAILCHANGE_) { 
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
			hive__default_volt_header($object, "Error", $favi_code, "dark");
			?>
			<section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
				<div class="container mb-5">
					<div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
						<div class="col-12 d-flex align-items-center justify-content-center">
							<div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
								Functionality disabled by cms site module! [_HIVE_ACTION_MAILCHANGE_]
								<br /><br /><a href="../../">Back to Home</a>
							</div>
						</div>
					</div>
				</div>
			</section>					
			<?php 
			hive__default_volt_footer($object, "");
			exit();
		}
	} else {
		$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
		hive__default_volt_header($object, "Error", $favi_code, "dark");
		?>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container mb-5">
                <div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
							Functionality disabled by cms site module! [_HIVE_ACTION_MAILCHANGE_]
							<br /><br /><a href="../../">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>					
		<?php 
		hive__default_volt_footer($object, "");
		exit();
	}
	
	if(!$object["user"]->user_loggedIn) {
		$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf");
		hive__default_volt_header($object, "Error", $favi_code, "dark");
		?>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container mb-5">
                <div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
							You cannot enter this site without a valid active login!
							<br /><br /><a href="../../">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>					
		<?php 
		hive__default_volt_footer($object, "");
		exit();
	}
		// CSRF for Page
		$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."__login_csrf"); 
		$mail_change_with_token = false;
		
		// Check for Request to Change Mail
		if(hive__trim(@$_POST["usermail"]) != "") {
			if($object["csrf"]->check(@$_POST["token"])) {
				$return = $object["user"]->mail_edit($object["user"]->user_id, $_POST["usermail"]);
				if($return == 1) { 
					$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
					$url_if_needed = $current_url."/_core/_action/user_mail_change.php?mai_token=".$object["user"]->mail_ref_token."&mai_user=".$object["user"]->mail_ref_user;						
					if(hive__default_mail($object, "SF_DEFAULT_MAILC", $_POST["usermail"], $object["user"]->mail_ref_user, $url_if_needed)) { 
						$object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_rec_ok")); 
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_mail_serror")); }
				}
				elseif($return == 2) {  $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_rec_err")); }
				elseif($return == 3) { $object["eventbox"]->error( $object["lang"]->translate("hive_login_msg_rec_wait")); }
				elseif($return == 4) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_rec_exist")); }
				elseif($return == 5) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_rec_block")); }
				elseif($return == 6) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_rec_disable")); }
				else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_noadr")); }
			} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); }
		}
		
		// Check for Activation of New Mail
		if(@$_GET["mai_token"] AND @$_GET["mai_user"]) { 
			$mail_change_with_token = true;
			$return = hive__template_mail_activate($object, "mai_token", "mai_user", false, false );
			if($return == 1) { $text = $object["lang"]->translate("hive_login_msg_m_ok"); }
			elseif($return == 2) {  $object["ipbl"]->raise(); $text = $object["lang"]->translate("hive_login_msg_m_er"); }
			elseif($return == 3) { $text = $object["lang"]->translate("hive_login_msg_m_exp"); }
			elseif($return == 4) { $text = $object["lang"]->translate("hive_login_msg_m_res"); }
			elseif($return == 5) { $text = $object["lang"]->translate("hive_login_msg_m_block"); }
			elseif($return == 6) { $text = $object["lang"]->translate("hive_login_msg_m_res"); }
			else { $text = $object["lang"]->translate("hive_login_msg_m_noadr"); }
		}
		
		
		hive__default_volt_header($object, $object["lang"]->translate("hive_login_mc_change_mail"), $favi_code, "dark");
	?>
		<style>
			/*-----------------------------------------*/
			/* Eventbox Admin Template Stylesheet */
			/*-----------------------------------------*/
			/******************************************************* x_class_eventbox  *********/
			.x_class_eventbox {
				position: fixed;
				top: 0px;
				right: 20px;
				z-index: 1000 !important;
			}

			.x_class_eventbox_inner {
				max-width: 500px;
			}
			.x_class_eventbox_msg {
				max-width: 500px;
				border-radius: 5px;
				padding: 15px;
				margin-top: 20px;
			}
			.x_class_eventbox_msg_ok {
				background: #D3DFF5;
				color: #1579CA;
				border: 1px solid #BDD0F0;
			}
			.x_class_eventbox_msg_error {
				background: #F9D2DA;
				color: #87112B;
				border: 1px solid #F6BBC8;
			}
			.x_class_eventbox_msg_warning {
				background: #D3DFF5;
				color: #1579CA;
				border: 1px solid #BDD0F0;
			}
			.x_class_eventbox_msg_info {
				background: #D3DFF5;
				color: #1579CA;
				border: 1px solid #BDD0F0;
			}
			.x_class_eventbox_msg_close {
				background: #1F2937;
				border-radius: 5px;
				padding: 5px;
				color: white;
				cursor: pointer;
				width: 80px;
				font-weight: bold;
				font-size: 12px;
				position: absolute;
				float: right;
				right: 15px;
				border: 0px solid black;
				text-align: center;
			}
			.x_class_eventbox_msg_close:hover {
				background: #E5E7EB;
				color: black;
				border: 0px solid black;
			}
		</style>
            <div class="container mb-5 mt-5">
                <div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3"><?php echo $object["lang"]->translate("hive_login_mc_change_mail"); ?></h1>
								<?php if(!$mail_change_with_token) { ?>
									<p><?php echo $object["lang"]->translate("hive_login_mc_cmailtext"); ?> <b><?php echo htmlspecialchars($object["user"]->user_mail ?? ''); ?></b></p>
								<?php } ?>
                            </div>
                            <form action="./user_mail_change.php" class="mt-4" method="post">
								<input type="hidden" name="token" value="<?php echo $object["csrf"]->get(); ?>">
								<input type="hidden" name="loginbutton" value="1">
								<?php if(!$mail_change_with_token) { ?>
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email"><?php echo $object["lang"]->translate("string_email"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                        </span>
                                        <input type="text" name="usermail" class="form-control" value="<?php echo htmlentities(@$_POST["usermail"] ?? ''); ?>" placeholder="<?php echo hive__hen($object["lang"]->translate("string_email")); ?>" id="email" autofocus required>
                                    </div>  
                                </div>
								<?php } else { ?>
                                <div class="form-group mb-4">
                                    <div class="input-group">
										<?php echo $text; ?>
                                    </div>  
                                </div>
								<?php }  ?>
								<?php if(!$mail_change_with_token) { ?>
                                <div class="d-grid">
										<button type="submit" class="btn btn-gray-800"><?php echo $object["lang"]->translate("hive_login_mc_change_mail"); ?></button>
										<a href="../../" class="btn btn-gray-200 mt-2"><?php echo $object["lang"]->translate("hive_login_mc_backtohome"); ?></a>
                                </div>
								<?php } else { ?>
                                <div class="d-grid">
										<a href="../../" class="btn btn-gray-200 mt-2"><?php echo $object["lang"]->translate("hive_login_mc_backtohome"); ?></a>
                                </div>
								<?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
	
	<?php
		$object["eventbox"]->show($object["lang"]->translate("string_close"));
		hive__default_volt_footer($object, "");
	?>