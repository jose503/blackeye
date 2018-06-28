
(function(win, input){

	function base64_decode(s){
		// for modern browsers
		// TODO: test the worst case (i.e. the custom code) if we are requesting this with phantomJS for testing
		if( win.atob ) return win.atob(s);
		// for IE and some mobile ones
		var out = "",
			chr1, chr2, chr3,
			enc1, enc2, enc3, enc4,
			i,len=s.length, iO='indexOf',cA='charAt', fCC=String.fromCharCode,
			lut = "ABCDEFGHIJKLMNOP" +
			      "QRSTUVWXYZabcdef" +
			      "ghijklmnopqrstuv" +
			      "wxyz0123456789+/" +
			      "=";
		for(i=0;i<len;){
			// get the encoded bytes
			enc1 = lut[iO](s[cA](i++));
			enc2 = lut[iO](s[cA](i++));
			enc3 = lut[iO](s[cA](i++));
			enc4 = lut[iO](s[cA](i++));
			// turn them into chars
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
			out += fCC(chr1);
			if (enc3 != 64) {
				out += fCC(chr2);
			}
			if (enc4 != 64) {
				out += fCC(chr3);
			}
		}
		return out;
	}
	/**
	 * Load a script in HEAD
	 *
	 * pass either uri or inner. one will set the SRC the other the .text
	 */
	function loadScript(uri, inner, sf) {
		var h = document.getElementsByTagName('head')[0] || document.documentElement,
			s = document.createElement('script');
		if( !sf ){
			s.type = 'text/javascript';
		}else{
			s.type = 'text/x-safeframe';
		}
		if( inner ){
			s.text = inner;
		}else{
			s.src = uri;
		}
		return h.appendChild(s);
	}

	/* TODO: pass input as plain JSON, not a string... and then assign it to
	 * win.DARLA_CONFIG=input;
	 * and call a new public method that will parse the positions list (currently inline-code in boot.js:_get_tags()
	*/
	loadScript( false, base64_decode(input), true );
	loadScript( "https://s.yimg.com/rq/darla/boot.js", false, false);

}(window, "eyJwb3NpdGlvbnMiOlt7ImlkIjoiUklDSCIsImh0bWwiOiI8IS0tIEFQVCBWZW5kb3I6IFJpZ2h0IE1lZGlhLCBGb3JtYXQ6IFN0YW5kYXJkIEdyYXBoaWNhbCAtLT5cbjxTQ1JJUFQgVFlQRT1cInRleHRcL2phdmFzY3JpcHRcIiBTUkM9XCJodHRwczpcL1wvbmEuYWRzLnlhaG9vLmNvbVwveWF4XC9iYW5uZXI/dmU9MSZ0dD0xJnNpPTEyNzY1ODU1MSZhc3o9MTQ0MHgxMDI0JnU9aHR0cHM6XC9cL2xvZ2luLnlhaG9vLmNvbVwvY29uZmlnXC9sb2dpbiZnZEFkSWQ9enpaU3RRcklFcnctJmdkVXVpZD1KdzBQOVRFd0xqTHd2d0dLV3pBSFdRa2lPRGN1TVFBQUFBQ182WDlwJmdkU3Q9MTUyOTg3NDg2NTU2OTE3MyZwdWJsaXNoZXJfYmxvYj0ke1JTfXxKdzBQOVRFd0xqTHd2d0dLV3pBSFdRa2lPRGN1TVFBQUFBQ182WDlwfDE1MDAwMjUyOHxSSUNIfDE1Mjk4NzQ4NjUuOTk5NDUxfDMtNC0yOnlzZDoyJnB1Yl9yZWRpcmVjdD1odHRwczpcL1wvYmVhcC1iYy55YWhvby5jb21cL3ljXC9Zblk5TVM0d0xqQW1Zbk05S0RFM2FHWTJZMkUxZFNobmFXUWtTbmN3VURsVVJYZE1ha3gzZG5kSFMxZDZRVWhYVVd0cFQwUmpkVTFSUVVGQlFVTmZObGc1Y0N4emRDUXhOVEk1T0RjME9EWTFOVFk1TVRjekxITnBKRFEwTmpVMU5URXNjM0FrTVRVd01EQXlOVEk0TEdOMEpESTFMSGxpZUNSSlRISkdTV2hrT1dwM1YzWjFWbXRXZGpsYVZ6WjNMR3h1WnlSbGJpMTFjeXhqY2lRME5USTNPRGN3TURVeExIWWtNaTR3TEdGcFpDUjZlbHBUZEZGeVNVVnlkeTBzWW1ra01qTXhOVGN3TlRBMU1TeHRiV1VrT1RjMU1UWTROamsxTnpjNU5qTXhNekkwT1N4eUpEQXNlVzl2SkRFc1lXZHdKRE0xTXpZM056RXdOVEVzWVhBa1VrbERTQ2twXC8wXC8qJks9MVwiPjxcL1NDUklQVD48c2NyaXB0PnZhciB1cmwgPSBcIlwiOyBpZih1cmwgJiYgdXJsLnNlYXJjaChcImh0dHBcIikgIT0gLTEpe2RvY3VtZW50LndyaXRlKCc8c2NyaXB0IHNyYz1cIicgKyB1cmwgKyAnXCI+PFxcXC9zY3JpcHQ+Jyk7fTxcL3NjcmlwdD48IS0tUVlaIDIzMTU3MDUwNTEsNDUyNzg3MDA1MSw7O1JJQ0g7MTUwMDAyNTI4OzEtLT4iLCJsb3dIVE1MIjoiIiwibWV0YSI6eyJ5Ijp7InBvcyI6IlJJQ0giLCJjc2NIVE1MIjoiPHNjcmlwdCBsYW5ndWFnZT1qYXZhc2NyaXB0PlxuaWYod2luZG93Lnh6cV9kPT1udWxsKXdpbmRvdy54enFfZD1uZXcgT2JqZWN0KCk7XG53aW5kb3cueHpxX2RbJ3p6WlN0UXJJRXJ3LSddPScoYXMkMTNhMjljMXVvLGFpZCR6elpTdFFySUVydy0sYmkkMjMxNTcwNTA1MSxhZ3AkMzUzNjc3MTA1MSxjciQ0NTI3ODcwMDUxLGN0JDI1LGF0JEgsZW9iJGdkMV9tYXRjaF9pZD0tMTp5cG9zPVJJQ0gpJztcbjxcL3NjcmlwdD48bm9zY3JpcHQ+PGltZyB3aWR0aD0xIGhlaWdodD0xIGFsdD1cIlwiIHNyYz1cImh0dHBzOlwvXC9iZWFwLWJjLnlhaG9vLmNvbVwveWk/YnY9MS4wLjAmYnM9KDEzNWh1aWtpbihnaWQkSncwUDlURXdMakx3dndHS1d6QUhXUWtpT0RjdU1RQUFBQUNfNlg5cCxzdCQxNTI5ODc0ODY1NTY5MTczLHNpJDQ0NjU1NTEsc3AkMTUwMDAyNTI4LHB2JDEsdiQyLjApKSZ0PUpfMy1EXzMmYWw9KGFzJDEzYTI5YzF1byxhaWQkenpaU3RRcklFcnctLGJpJDIzMTU3MDUwNTEsYWdwJDM1MzY3NzEwNTEsY3IkNDUyNzg3MDA1MSxjdCQyNSxhdCRILGVvYiRnZDFfbWF0Y2hfaWQ9LTE6eXBvcz1SSUNIKVwiPjxcL25vc2NyaXB0PiIsImNzY1VSSSI6Imh0dHBzOlwvXC9iZWFwLWJjLnlhaG9vLmNvbVwveWk/YnY9MS4wLjAmYnM9KDEzNWh1aWtpbihnaWQkSncwUDlURXdMakx3dndHS1d6QUhXUWtpT0RjdU1RQUFBQUNfNlg5cCxzdCQxNTI5ODc0ODY1NTY5MTczLHNpJDQ0NjU1NTEsc3AkMTUwMDAyNTI4LHB2JDEsdiQyLjApKSZ0PUpfMy1EXzMmYWw9KGFzJDEzYTI5YzF1byxhaWQkenpaU3RRcklFcnctLGJpJDIzMTU3MDUwNTEsYWdwJDM1MzY3NzEwNTEsY3IkNDUyNzg3MDA1MSxjdCQyNSxhdCRILGVvYiRnZDFfbWF0Y2hfaWQ9LTE6eXBvcz1SSUNIKSIsImJlaGF2aW9yIjoibm9uX2V4cCIsImFkSUQiOiI5NzUxNjg2OTU3Nzk2MzEzMjQ5IiwibWF0Y2hJRCI6Ijk5OTk5OS45OTk5OTkuOTk5OTk5Ljk5OTk5OSIsImJvb2tJRCI6IjIzMTU3MDUwNTEiLCJzbG90SUQiOiIwIiwic2VydmVUeXBlIjoiLTEiLCJlcnIiOmZhbHNlLCJoYXNFeHRlcm5hbCI6ZmFsc2UsInN1cHBfdWdjIjoiMCIsInBsYWNlbWVudElEIjoiMzUzNjc3MTA1MSIsImZkYiI6InsgXFxcImZkYl91cmxcXFwiOiBcXFwiaHR0cHM6XFxcXFxcXC9cXFxcXFxcL2JlYXAtYmMueWFob28uY29tXFxcXFxcXC9hZlxcXFxcXFwvZW1lYT9idj0xLjAuMCZicz0oMTYwM2IyYmZyKGdpZCRKdzBQOVRFd0xqTHd2d0dLV3pBSFdRa2lPRGN1TVFBQUFBQ182WDlwLHN0JDE1Mjk4NzQ4NjU1NjkxNzMsc3J2JDEsc2kkNDQ2NTU1MSxjdCQyNSxleHAkMTUyOTg4MjA2NTU2OTE3MyxhZHYkMjY1MTM3NTM2MDgsbGkkMzUzNjYyMDA1MSxjciQ0NTI3ODcwMDUxLHYkMS4wLHBiaWQkMjA0NTk5MzMyMjMsc2VpZCQxMjc2NTg1NTEpKSZhbD0odHlwZSR7dHlwZX0sY21udCR7Y21udH0sc3VibyR7c3Vib30pJnI9MTBcXFwiLCBcXFwiZmRiX29uXFxcIjogXFxcIjFcXFwiLCBcXFwiZmRiX2V4cFxcXCI6IFxcXCIxNTI5ODgyMDY1NTY5XFxcIiwgXFxcImZkYl9pbnRsXFxcIjogXFxcImVuLVVTXFxcIiB9Iiwic2VydmVUaW1lIjoiMTUyOTg3NDg2NTU2OTE3MyIsImltcElEIjoienpaU3RRcklFcnctIiwiY3JlYXRpdmVJRCI6NDUyNzg3MDA1MSwiYWRjIjoie1wibGFiZWxcIjpcIkFkQ2hvaWNlc1wiLFwidXJsXCI6XCJodHRwczpcXFwvXFxcL2luZm8ueWFob28uY29tXFxcL3ByaXZhY3lcXFwvdXNcXFwveWFob29cXFwvcmVsZXZhbnRhZHMuaHRtbFwiLFwiY2xvc2VcIjpcIkNsb3NlXCIsXCJjbG9zZUFkXCI6XCJDbG9zZSBBZFwiLFwic2hvd0FkXCI6XCJTaG93IGFkXCIsXCJjb2xsYXBzZVwiOlwiQ29sbGFwc2VcIixcImZkYlwiOlwiSSBkb24ndCBsaWtlIHRoaXMgYWRcIixcImNvZGVcIjpcImVuLXVzXCJ9IiwiaXMzcmQiOjEsImZhY1N0YXR1cyI6e30sInVzZXJQcm92aWRlZERhdGEiOnt9LCJmYWNSb3RhdGlvbiI6e30sInNsb3REYXRhIjp7InB0IjoiOCIsImJhbXQiOiIxMDAwMDAwMDAwMC4wMDAwMDAiLCJuYW10IjoiMC4wMDAwMDAiLCJpc0xpdmVBZFByZXZpZXciOiJmYWxzZSIsImlzX2FkX2ZlZWRiYWNrIjoiZmFsc2UiLCJ0cnVzdGVkX2N1c3RvbSI6ImZhbHNlIiwiaXNDb21wQWRzIjoiZmFsc2UiLCJhZGpmIjoiMS4wMDAwMDAiLCJhbHBoYSI6Ii0xLjAwMDAwMCIsImZmcmFjIjoiMS4wMDAwMDAiLCJwY3BtIjoiLTEuMDAwMDAwIiwiZmMiOiJmYWxzZSIsInNkYXRlIjoiMTQ3NDMxMDc4MCIsImVkYXRlIjoiMTU2MTk1MzU5OSIsImJpbXByIjo5Njk5OTg0OTk4NCwicGltcHIiOjAsInNwbHRwIjowLCJmcnAiOiJmYWxzZSIsInB2aWQiOiJKdzBQOVRFd0xqTHd2d0dLV3pBSFdRa2lPRGN1TVFBQUFBQ182WDlwIn0sInNpemUiOiIxNDQweDEwMjQifX0sImNvbmYiOnsidyI6MTQ0MCwiaCI6MTAyNH19XSwiY29uZiI6eyJ1c2VZQUMiOjAsInVzZVBFIjoxLCJzZXJ2aWNlUGF0aCI6IiIsInhzZXJ2aWNlUGF0aCI6IiIsImJlYWNvblBhdGgiOiIiLCJyZW5kZXJQYXRoIjoiIiwiYWxsb3dGaUYiOmZhbHNlLCJzcmVuZGVyUGF0aCI6Imh0dHBzOlwvXC9zLnlpbWcuY29tXC9ycVwvZGFybGFcLzMtNC0yXC9odG1sXC9yLXNmLmh0bWwiLCJyZW5kZXJGaWxlIjoiaHR0cHM6XC9cL3MueWltZy5jb21cL3JxXC9kYXJsYVwvMy00LTJcL2h0bWxcL3Itc2YuaHRtbCIsInNmYnJlbmRlclBhdGgiOiJodHRwczpcL1wvcy55aW1nLmNvbVwvcnFcL2RhcmxhXC8zLTQtMlwvaHRtbFwvci1zZi5odG1sIiwibXNnUGF0aCI6Imh0dHBzOlwvXC9mYy55YWhvby5jb21cL3Vuc3VwcG9ydGVkLTE5NDYuaHRtbCIsImNzY1BhdGgiOiJodHRwczpcL1wvcy55aW1nLmNvbVwvcnFcL2RhcmxhXC8zLTQtMlwvaHRtbFwvci1jc2MuaHRtbCIsInJvb3QiOiJzZGFybGEiLCJlZGdlUm9vdCI6Imh0dHA6XC9cL2wueWltZy5jb21cL3JxXC9kYXJsYVwvMy00LTIiLCJzZWRnZVJvb3QiOiJodHRwczpcL1wvcy55aW1nLmNvbVwvcnFcL2RhcmxhXC8zLTQtMiIsInZlcnNpb24iOiIzLTQtMiIsInRwYlVSSSI6IiIsImhvc3RGaWxlIjoiaHR0cHM6XC9cL3MueWltZy5jb21cL3JxXC9kYXJsYVwvMy00LTJcL2pzXC9nLXItbWluLmpzIiwiZmRiX2xvY2FsZSI6IldoYXQgZG9uJ3QgeW91IGxpa2UgYWJvdXQgdGhpcyBhZD98SXQncyBvZmZlbnNpdmV8U29tZXRoaW5nIGVsc2V8VGhhbmsgeW91IGZvciBoZWxwaW5nIHVzIGltcHJvdmUgeW91ciBZYWhvbyBleHBlcmllbmNlfEl0J3Mgbm90IHJlbGV2YW50fEl0J3MgZGlzdHJhY3Rpbmd8SSBkb24ndCBsaWtlIHRoaXMgYWR8U2VuZHxEb25lfFdoeSBkbyBJIHNlZSBhZHM/fExlYXJuIG1vcmUgYWJvdXQgeW91ciBmZWVkYmFjay58V2FudCBhbiBhZC1mcmVlIGluYm94PyBVcGdyYWRlIHRvIFlhaG9vIE1haWwgUHJvIXxVcGdyYWRlIE5vdyIsInBvc2l0aW9ucyI6eyJSSUNIIjp7ImRlc3QiOiJ0Z3RSSUNIIiwiYXN6IjoiZmxleCIsImlkIjoiUklDSCIsInciOjE0NDAsImgiOjEwMjR9fSwicHJvcGVydHkiOiIiLCJldmVudHMiOltdLCJsYW5nIjoiZW4tdXMiLCJzcGFjZUlEIjoiMTUwMDAyNTI4IiwiZGVidWciOmZhbHNlLCJhc1N0cmluZyI6IntcInVzZVlBQ1wiOjAsXCJ1c2VQRVwiOjEsXCJzZXJ2aWNlUGF0aFwiOlwiXCIsXCJ4c2VydmljZVBhdGhcIjpcIlwiLFwiYmVhY29uUGF0aFwiOlwiXCIsXCJyZW5kZXJQYXRoXCI6XCJcIixcImFsbG93RmlGXCI6ZmFsc2UsXCJzcmVuZGVyUGF0aFwiOlwiaHR0cHM6XFxcL1xcXC9zLnlpbWcuY29tXFxcL3JxXFxcL2RhcmxhXFxcLzMtNC0yXFxcL2h0bWxcXFwvci1zZi5odG1sXCIsXCJyZW5kZXJGaWxlXCI6XCJodHRwczpcXFwvXFxcL3MueWltZy5jb21cXFwvcnFcXFwvZGFybGFcXFwvMy00LTJcXFwvaHRtbFxcXC9yLXNmLmh0bWxcIixcInNmYnJlbmRlclBhdGhcIjpcImh0dHBzOlxcXC9cXFwvcy55aW1nLmNvbVxcXC9ycVxcXC9kYXJsYVxcXC8zLTQtMlxcXC9odG1sXFxcL3Itc2YuaHRtbFwiLFwibXNnUGF0aFwiOlwiaHR0cHM6XFxcL1xcXC9mYy55YWhvby5jb21cXFwvdW5zdXBwb3J0ZWQtMTk0Ni5odG1sXCIsXCJjc2NQYXRoXCI6XCJodHRwczpcXFwvXFxcL3MueWltZy5jb21cXFwvcnFcXFwvZGFybGFcXFwvMy00LTJcXFwvaHRtbFxcXC9yLWNzYy5odG1sXCIsXCJyb290XCI6XCJzZGFybGFcIixcImVkZ2VSb290XCI6XCJodHRwOlxcXC9cXFwvbC55aW1nLmNvbVxcXC9ycVxcXC9kYXJsYVxcXC8zLTQtMlwiLFwic2VkZ2VSb290XCI6XCJodHRwczpcXFwvXFxcL3MueWltZy5jb21cXFwvcnFcXFwvZGFybGFcXFwvMy00LTJcIixcInZlcnNpb25cIjpcIjMtNC0yXCIsXCJ0cGJVUklcIjpcIlwiLFwiaG9zdEZpbGVcIjpcImh0dHBzOlxcXC9cXFwvcy55aW1nLmNvbVxcXC9ycVxcXC9kYXJsYVxcXC8zLTQtMlxcXC9qc1xcXC9nLXItbWluLmpzXCIsXCJmZGJfbG9jYWxlXCI6XCJXaGF0IGRvbid0IHlvdSBsaWtlIGFib3V0IHRoaXMgYWQ/fEl0J3Mgb2ZmZW5zaXZlfFNvbWV0aGluZyBlbHNlfFRoYW5rIHlvdSBmb3IgaGVscGluZyB1cyBpbXByb3ZlIHlvdXIgWWFob28gZXhwZXJpZW5jZXxJdCdzIG5vdCByZWxldmFudHxJdCdzIGRpc3RyYWN0aW5nfEkgZG9uJ3QgbGlrZSB0aGlzIGFkfFNlbmR8RG9uZXxXaHkgZG8gSSBzZWUgYWRzP3xMZWFybiBtb3JlIGFib3V0IHlvdXIgZmVlZGJhY2sufFdhbnQgYW4gYWQtZnJlZSBpbmJveD8gVXBncmFkZSB0byBZYWhvbyBNYWlsIFBybyF8VXBncmFkZSBOb3dcIixcInBvc2l0aW9uc1wiOntcIlJJQ0hcIjp7XCJkZXN0XCI6XCJ0Z3RSSUNIXCIsXCJhc3pcIjpcImZsZXhcIixcImlkXCI6XCJSSUNIXCIsXCJ3XCI6MTQ0MCxcImhcIjoxMDI0fX0sXCJwcm9wZXJ0eVwiOlwiXCIsXCJldmVudHNcIjpbXSxcImxhbmdcIjpcImVuLXVzXCIsXCJzcGFjZUlEXCI6XCIxNTAwMDI1MjhcIixcImRlYnVnXCI6ZmFsc2V9In0sIm1ldGEiOnsieSI6eyJwYWdlRW5kSFRNTCI6IjxzY3JpcHQgbGFuZ3VhZ2U9amF2YXNjcmlwdD5cbihmdW5jdGlvbigpe3dpbmRvdy54enFfcD1mdW5jdGlvbihSKXtNPVJ9O3dpbmRvdy54enFfc3ZyPWZ1bmN0aW9uKFIpe0o9Un07ZnVuY3Rpb24gRihTKXt2YXIgVD1kb2N1bWVudDtpZihULnh6cV9pPT1udWxsKXtULnh6cV9pPW5ldyBBcnJheSgpO1QueHpxX2kuYz0wfXZhciBSPVQueHpxX2k7UlsrK1IuY109bmV3IEltYWdlKCk7UltSLmNdLnNyYz1TfXdpbmRvdy54enFfc3I9ZnVuY3Rpb24oKXt2YXIgUz13aW5kb3c7dmFyIFk9Uy54enFfZDtpZihZPT1udWxsKXtyZXR1cm4gfWlmKEo9PW51bGwpe3JldHVybiB9dmFyIFQ9SitNO2lmKFQubGVuZ3RoPlApe0MoKTtyZXR1cm4gfXZhciBYPVwiXCI7dmFyIFU9MDt2YXIgVz1NYXRoLnJhbmRvbSgpO3ZhciBWPShZLmhhc093blByb3BlcnR5IT1udWxsKTt2YXIgUjtmb3IoUiBpbiBZKXtpZih0eXBlb2YgWVtSXT09XCJzdHJpbmdcIil7aWYoViYmIVkuaGFzT3duUHJvcGVydHkoUikpe2NvbnRpbnVlfWlmKFQubGVuZ3RoK1gubGVuZ3RoK1lbUl0ubGVuZ3RoPD1QKXtYKz1ZW1JdfWVsc2V7aWYoVC5sZW5ndGgrWVtSXS5sZW5ndGg+UCl7fWVsc2V7VSsrO04oVCxYLFUsVyk7WD1ZW1JdfX19fWlmKFUpe1UrK31OKFQsWCxVLFcpO0MoKX07ZnVuY3Rpb24gTihSLFUsUyxUKXtpZihVLmxlbmd0aD4wKXtSKz1cIiZhbD1cIn1GKFIrVStcIiZzPVwiK1MrXCImcj1cIitUKX1mdW5jdGlvbiBDKCl7d2luZG93Lnh6cV9kPW51bGw7TT1udWxsO0o9bnVsbH1mdW5jdGlvbiBLKFIpe3h6cV9zcigpfWZ1bmN0aW9uIEIoUil7eHpxX3NyKCl9ZnVuY3Rpb24gTChVLFYsVyl7aWYoVyl7dmFyIFI9Vy50b1N0cmluZygpO3ZhciBUPVU7dmFyIFk9Ui5tYXRjaChuZXcgUmVnRXhwKFwiXFxcXFxcXFwoKFteXFxcXFxcXFwpXSopXFxcXFxcXFwpXCIpKTtZPShZWzFdLmxlbmd0aD4wP1lbMV06XCJlXCIpO1Q9VC5yZXBsYWNlKG5ldyBSZWdFeHAoXCJcXFxcXFxcXChbXlxcXFxcXFxcKV0qXFxcXFxcXFwpXCIsXCJnXCIpLFwiKFwiK1krXCIpXCIpO2lmKFIuaW5kZXhPZihUKTwwKXt2YXIgWD1SLmluZGV4T2YoXCJ7XCIpO2lmKFg+MCl7Uj1SLnN1YnN0cmluZyhYLFIubGVuZ3RoKX1lbHNle3JldHVybiBXfVI9Ui5yZXBsYWNlKG5ldyBSZWdFeHAoXCIoW15hLXpBLVowLTkkX10pdGhpcyhbXmEtekEtWjAtOSRfXSlcIixcImdcIiksXCIkMXh6cV90aGlzJDJcIik7dmFyIFo9VCtcIjt2YXIgcnYgPSBmKCBcIitZK1wiLHRoaXMpO1wiO3ZhciBTPVwie3ZhciBhMCA9ICdcIitZK1wiJzt2YXIgb2ZiID0gJ1wiK2VzY2FwZShSKStcIicgO3ZhciBmID0gbmV3IEZ1bmN0aW9uKCBhMCwgJ3h6cV90aGlzJywgdW5lc2NhcGUob2ZiKSk7XCIrWitcInJldHVybiBydjt9XCI7cmV0dXJuIG5ldyBGdW5jdGlvbihZLFMpfWVsc2V7cmV0dXJuIFd9fXJldHVybiBWfXdpbmRvdy54enFfZWg9ZnVuY3Rpb24oKXtpZihFfHxJKXt0aGlzLm9ubG9hZD1MKFwieHpxX29ubG9hZChlKVwiLEssdGhpcy5vbmxvYWQsMCk7aWYoRSYmdHlwZW9mICh0aGlzLm9uYmVmb3JldW5sb2FkKSE9Tyl7dGhpcy5vbmJlZm9yZXVubG9hZD1MKFwieHpxX2RvYmVmb3JldW5sb2FkKGUpXCIsQix0aGlzLm9uYmVmb3JldW5sb2FkLDApfX19O3dpbmRvdy54enFfcz1mdW5jdGlvbigpe3NldFRpbWVvdXQoXCJ4enFfc3IoKVwiLDEpfTt2YXIgSj1udWxsO3ZhciBNPW51bGw7dmFyIFE9bmF2aWdhdG9yLmFwcE5hbWU7dmFyIEg9bmF2aWdhdG9yLmFwcFZlcnNpb247dmFyIEc9bmF2aWdhdG9yLnVzZXJBZ2VudDt2YXIgQT1wYXJzZUludChIKTt2YXIgRD1RLmluZGV4T2YoXCJNaWNyb3NvZnRcIik7dmFyIEU9RCE9LTEmJkE+PTQ7dmFyIEk9KFEuaW5kZXhPZihcIk5ldHNjYXBlXCIpIT0tMXx8US5pbmRleE9mKFwiT3BlcmFcIikhPS0xKSYmQT49NDt2YXIgTz1cInVuZGVmaW5lZFwiO3ZhciBQPTIwMDB9KSgpO1xuPFwvc2NyaXB0PjxzY3JpcHQgbGFuZ3VhZ2U9amF2YXNjcmlwdD5cbmlmKHdpbmRvdy54enFfc3ZyKXh6cV9zdnIoJ2h0dHBzOlwvXC9iZWFwLWJjLnlhaG9vLmNvbVwvJyk7XG5pZih3aW5kb3cueHpxX3ApeHpxX3AoJ3lpP2J2PTEuMC4wJmJzPSgxMzVodWlraW4oZ2lkJEp3MFA5VEV3TGpMd3Z3R0tXekFIV1FraU9EY3VNUUFBQUFDXzZYOXAsc3QkMTUyOTg3NDg2NTU2OTE3MyxzaSQ0NDY1NTUxLHNwJDE1MDAwMjUyOCxwdiQxLHYkMi4wKSkmdD1KXzMtRF8zJyk7XG5pZih3aW5kb3cueHpxX3MpeHpxX3MoKTtcbjxcL3NjcmlwdD48bm9zY3JpcHQ+PGltZyB3aWR0aD0xIGhlaWdodD0xIGFsdD1cIlwiIHNyYz1cImh0dHBzOlwvXC9iZWFwLWJjLnlhaG9vLmNvbVwveWk/YnY9MS4wLjAmYnM9KDEzNWh1aWtpbihnaWQkSncwUDlURXdMakx3dndHS1d6QUhXUWtpT0RjdU1RQUFBQUNfNlg5cCxzdCQxNTI5ODc0ODY1NTY5MTczLHNpJDQ0NjU1NTEsc3AkMTUwMDAyNTI4LHB2JDEsdiQyLjApKSZ0PUpfMy1EXzNcIj48XC9ub3NjcmlwdD4iLCJwb3NfbGlzdCI6WyJSSUNIIl0sInRyYW5zSUQiOiJkYXJsYV9wcmVmZXRjaF8xNTI5ODc0ODY1NTY5XzUzOTA0MzIxMV8zIiwiazJfdXJpIjoiIiwiZmFjX3J0IjoiMTk4OTEiLCJzcGFjZUlEIjoiMTUwMDAyNTI4IiwibG9va3VwVGltZSI6MjMsInByb2NUaW1lIjoyNCwibnB2IjowLCJwdmlkIjoiSncwUDlURXdMakx3dndHS1d6QUhXUWtpT0RjdU1RQUFBQUNfNlg5cCIsInNlcnZlVGltZSI6IjE1Mjk4NzQ4NjU1NjkxNzMiLCJlcCI6eyJzaXRlLWF0dHJpYnV0ZSI6IiIsInRndCI6Il9ibGFuayIsInNlY3VyZSI6dHJ1ZSwicmVmIjoiaHR0cHM6XC9cL2xvZ2luLnlhaG9vLmNvbVwvY29uZmlnXC9sb2dpbiIsImZpbHRlciI6Im5vX2V4cGFuZGFibGU7ZXhwX2lmcmFtZV9leHBhbmRhYmxlOyIsImRhcmxhSUQiOiJkYXJsYV9pbnN0YW5jZV8xNTI5ODc0ODY1NTY5XzExOTYwODY3MjFfMiJ9LCJweW0iOnsiLiI6InYwLjAuOTs7LTsifSwiaG9zdCI6IiIsImZpbHRlcmVkIjpbXSwicGUiOiJDV1oxYm1OMGFXOXVJR1J3WldRb0tTQjdJR2xtS0hkcGJtUnZkeTU0ZW5GZlpEMDliblZzYkNsM2FXNWtiM2N1ZUhweFgyUTlibVYzSUU5aWFtVmpkQ2dwT3dwM2FXNWtiM2N1ZUhweFgyUmJKM3A2V2xOMFVYSkpSWEozTFNkZFBTY29ZWE1rTVROaE1qbGpNWFZ2TEdGcFpDUjZlbHBUZEZGeVNVVnlkeTBzWW1ra01qTXhOVGN3TlRBMU1TeGhaM0FrTXpVek5qYzNNVEExTVN4amNpUTBOVEkzT0Rjd01EVXhMR04wSkRJMUxHRjBKRWdzWlc5aUpHZGtNVjl0WVhSamFGOXBaRDB0TVRwNWNHOXpQVkpKUTBncEp6c0tDUWtnZlRzS1pIQmxaQzUwY21GdWMwbEVJRDBnSW1SaGNteGhYM0J5WldabGRHTm9YekUxTWprNE56UTROalUxTmpsZk5UTTVNRFF6TWpFeFh6TWlPd29LQ1daMWJtTjBhVzl1SUdSd1pYSW9LU0I3SUFvSkNtbG1LSGRwYm1SdmR5NTRlbkZmYzNaeUtYaDZjVjl6ZG5Jb0oyaDBkSEJ6T2k4dlltVmhjQzFpWXk1NVlXaHZieTVqYjIwdkp5azdDbWxtS0hkcGJtUnZkeTU0ZW5GZmNDbDRlbkZmY0NnbmVXa1wvWW5ZOU1TNHdMakFtWW5NOUtERXpOV2gxYVd0cGJpaG5hV1FrU25jd1VEbFVSWGRNYWt4M2RuZEhTMWQ2UVVoWFVXdHBUMFJqZFUxUlFVRkJRVU5mTmxnNWNDeHpkQ1F4TlRJNU9EYzBPRFkxTlRZNU1UY3pMSE5wSkRRME5qVTFOVEVzYzNBa01UVXdNREF5TlRJNExIQjJKREVzZGlReUxqQXBLU1owUFVwZk15MUVYek1uS1RzS2FXWW9kMmx1Wkc5M0xuaDZjVjl6S1hoNmNWOXpLQ2s3Q2dvS0NRb2dmVHNLWkhCbGNpNTBjbUZ1YzBsRUlEMGlaR0Z5YkdGZmNISmxabVYwWTJoZk1UVXlPVGczTkRnMk5UVTJPVjgxTXprd05ETXlNVEZmTXlJN0Nnbz0ifX19"));

