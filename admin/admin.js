$(document).ready(function()
	{	
	$("#FormLgota .myBytton").click(function(e){FormLgotaGo(e); }).mouseout(ErrorHide);
	});



function LgotaSet(OBJ,tip)
	{
	FormLgota.tip.value=tip;
	$("#mySel P").text(OBJ.innerHTML);
	$("#mySel DD").hide();
	}

function FormLgotaGo(val,e)
	{
	if(!FormLgota.name.value)  ErrorView('�� ������� ������������.',e);
	else
		{
		znach=FormLgota.znach.value;
		if(!znach) ErrorView('�� ������� ��������.',e);
		else
			{
			var regMoney = /^[0-9]+$/;
			if(regMoney.exec(znach)==null)
				ErrorView('�������� ������� �����������.',e);
			else
				if(FormLgota.tip.value==1 && (znach==0 || znach>100)) ErrorView('������������ �������� � ���������.',e);
				else FormLgota.submit();
			}
		}
	}

