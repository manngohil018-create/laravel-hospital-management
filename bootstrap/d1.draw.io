<mxfile host="app.diagrams.net">
  <diagram id="lifecare-class-diagram" name="Class Diagram">
    <mxGraphModel dx="1422" dy="794" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1169" pageHeight="827" math="0" shadow="0">
      <root>
        <mxCell id="0" />
        <mxCell id="1" parent="0" />

        <!-- Title -->
        <mxCell id="title" value="&lt;b&gt;LifeCare Hospital Management System - Class Diagram&lt;/b&gt;" style="text;html=1;strokeColor=none;fillColor=none;align=center;verticalAlign=middle;whiteSpace=wrap;rounded=0;fontSize=15;" vertex="1" parent="1">
          <mxGeometry x="380" y="180" width="400" height="30" as="geometry" />
        </mxCell>

        <!-- User Class -->
        <mxCell id="class_user" value="User&#xa;--&#xa;+ id : int&#xa;+ username : string&#xa;+ email : string&#xa;+ password : string&#xa;+ role : string&#xa;--&#xa;+ login()&#xa;+ logout()&#xa;+ updateProfile()" style="swimlane;fontStyle=1;align=center;verticalAlign=top;childLayout=stackLayout;horizontal=1;startSize=26;horizontalStack=0;resizeParent=1;resizeParentMax=0;resizeLast=0;collapsible=0;marginBottom=0;whiteSpace=wrap;html=1;fillColor=#e1d5e7;strokeColor=#9673a6;fontSize=11;" vertex="1" parent="1">
          <mxGeometry x="458" y="240" width="130" height="160" as="geometry" />
        </mxCell>

        <!-- Admin Class -->
        <mxCell id="class_admin" value="Admin&#xa;--&#xa;+ admin_id : int&#xa;+ name : string&#xa;+ email : string&#xa;--&#xa;+ manageDoctors()&#xa;+ managePatients()&#xa;+ manageAppointments()&#xa;+ generateReports()" style="swimlane;fontStyle=1;align=center;verticalAlign=top;childLayout=stackLayout;horizontal=1;startSize=26;horizontalStack=0;resizeParent=1;resizeParentMax=0;resizeLast=0;collapsible=0;marginBottom=0;whiteSpace=wrap;html=1;fillColor=#fff2cc;strokeColor=#d6b656;fontSize=11;" vertex="1" parent="1">
          <mxGeometry x="600" y="350" width="150" height="150" as="geometry" />
        </mxCell>

        <!-- Patient Class -->
        <mxCell id="class_patient" value="Patient&#xa;--&#xa;+ patient_id : int&#xa;+ name : string&#xa;+ phone : string&#xa;+ address : string&#xa;--&#xa;+ searchDoctor()&#xa;+ bookAppointment()&#xa;+ viewAppointment()&#xa;+ cancelAppointment()" style="swimlane;fontStyle=1;align=center;verticalAlign=top;childLayout=stackLayout;horizontal=1;startSize=26;horizontalStack=0;resizeParent=1;resizeParentMax=0;resizeLast=0;collapsible=0;marginBottom=0;whiteSpace=wrap;html=1;fillColor=#d5e8d4;strokeColor=#82b366;fontSize=11;" vertex="1" parent="1">
          <mxGeometry x="290" y="445" width="150" height="160" as="geometry" />
        </mxCell>

        <!-- Doctor Class -->
        <mxCell id="class_doctor" value="Doctor&#xa;--&#xa;+ doctor_id : int&#xa;+ name : string&#xa;+ specialization : string&#xa;+ phone : string&#xa;--&#xa;+ viewAppointments()&#xa;+ acceptReject()&#xa;+ addPrescription()&#xa;+ viewReports()" style="swimlane;fontStyle=1;align=center;verticalAlign=top;childLayout=stackLayout;horizontal=1;startSize=26;horizontalStack=0;resizeParent=1;resizeParentMax=0;resizeLast=0;collapsible=0;marginBottom=0;whiteSpace=wrap;html=1;fillColor=#dae8fc;strokeColor=#6c8ebf;fontSize=11;" vertex="1" parent="1">
          <mxGeometry x="620" y="530" width="140" height="170" as="geometry" />
        </mxCell>

        <!-- Appointment Class -->
        <mxCell id="class_appointment" value="Appointment&#xa;--&#xa;+ appointment_id : int&#xa;+ patient_id : int&#xa;+ doctor_id : int&#xa;+ appointment_date : datetime&#xa;+ status : string&#xa;--&#xa;+ book()&#xa;+ cancel()&#xa;+ reschedule()" style="swimlane;fontStyle=1;align=center;verticalAlign=top;childLayout=stackLayout;horizontal=1;startSize=26;horizontalStack=0;resizeParent=1;resizeParentMax=0;resizeLast=0;collapsible=0;marginBottom=0;whiteSpace=wrap;html=1;fillColor=#ffe6cc;strokeColor=#d79b00;fontSize=11;" vertex="1" parent="1">
          <mxGeometry x="380" y="665" width="160" height="160" as="geometry" />
        </mxCell>

        <!-- MedicalHistory Class -->
        <mxCell id="class_medical_history" value="MedicalHistory&#xa;--&#xa;+ history_id : int&#xa;+ patient_id : int&#xa;+ diagnosis : string&#xa;+ date : date&#xa;--&#xa;+ addRecord()&#xa;+ getHistory()" style="swimlane;fontStyle=1;align=center;verticalAlign=top;childLayout=stackLayout;horizontal=1;startSize=26;horizontalStack=0;resizeParent=1;resizeParentMax=0;resizeLast=0;collapsible=0;marginBottom=0;whiteSpace=wrap;html=1;fillColor=#e1d5e7;strokeColor=#9673a6;fontSize=11;" vertex="1" parent="1">
          <mxGeometry x="553" y="715" width="120" height="145" as="geometry" />
        </mxCell>

        <!-- Inheritance: Admin -> User -->
        <mxCell id="inh_admin_user" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;endArrow=block;endFill=0;" edge="1" parent="1" source="class_admin" target="class_user">
          <mxGeometry relative="1" as="geometry">
            <Array as="points">
              <mxPoint x="640" y="320" />
              <mxPoint x="558" y="320" />
            </Array>
          </mxGeometry>
        </mxCell>

        <!-- Inheritance: Doctor -> User -->
        <mxCell id="inh_doctor_user" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;endArrow=block;endFill=0;" edge="1" parent="1" source="class_doctor" target="class_user">
          <mxGeometry relative="1" as="geometry">
            <Array as="points">
              <mxPoint x="518" y="615" />
            </Array>
          </mxGeometry>
        </mxCell>

        <!-- Association: Admin manages Doctor -->
        <mxCell id="assoc_admin_doctor" value="manages 1 : 0..*" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;endArrow=none;fontSize=9;labelBackgroundColor=#ffffff;" edge="1" parent="1" source="class_admin" target="class_doctor">
          <mxGeometry x="-0.2" relative="1" as="geometry">
            <Array as="points">
              <mxPoint x="425" y="425" />
              <mxPoint x="425" y="615" />
            </Array>
          </mxGeometry>
        </mxCell>

        <!-- Association: Patient has MedicalHistory -->
        <mxCell id="assoc_patient_history" value="has 1 : 0..*" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;endArrow=none;fontSize=9;labelBackgroundColor=#ffffff;" edge="1" parent="1" source="class_patient" target="class_medical_history">
          <mxGeometry x="-0.3" relative="1" as="geometry">
            <Array as="points">
              <mxPoint x="583" y="525" />
            </Array>
          </mxGeometry>
        </mxCell>

        <!-- Association: Patient books Appointment -->
        <mxCell id="assoc_patient_appointment" value="books 1 : 0..*" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;endArrow=none;fontSize=9;labelBackgroundColor=#ffffff;" edge="1" parent="1" source="class_patient" target="class_appointment">
          <mxGeometry x="-0.1" relative="1" as="geometry">
            <Array as="points">
              <mxPoint x="425" y="570" />
            </Array>
          </mxGeometry>
        </mxCell>

        <!-- Association: Doctor handles MedicalHistory -->
        <mxCell id="assoc_doctor_history" value="handles 1 : 0..*" style="edgeStyle=orthogonalEdgeStyle;rounded=0;orthogonalLoop=1;jettySize=auto;html=1;endArrow=none;fontSize=9;labelBackgroundColor=#ffffff;" edge="1" parent="1" source="class_doctor" target="class_medical_history">
          <mxGeometry x="-0.2" relative="1" as="geometry">
            <Array as="points">
              <mxPoint x="548" y="650" />
              <mxPoint x="548" y="750" />
            </Array>
          </mxGeometry>
        </mxCell>

      </root>
    </mxGraphModel>
  </diagram>
</mxfile>