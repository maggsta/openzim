<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:config="urn:oasis:names:tc:opendocument:xmlns:config:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:presentation="urn:oasis:names:tc:opendocument:xmlns:presentation:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:anim="urn:oasis:names:tc:opendocument:xmlns:animation:1.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:smil="urn:oasis:names:tc:opendocument:xmlns:smil-compatible:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:int="http://opendocumentfellowship.org/internal" xmlns="http://www.w3.org/1999/xhtml" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0" exclude-result-prefixes="office meta config text table draw presentation dr3d chart form script style number anim dc xlink math xforms fo svg smil ooo ooow oooc int #default">
  <xsl:output method="xml" indent="yes" omit-xml-declaration="no" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" encoding="UTF-8"/>
  <xsl:param xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="param_baseuri"/>
  <xsl:param xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="param_track_changes"/>
  <xsl:param xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="param_no_css"/>
  <xsl:param xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="param_css_only"/>
  <xsl:param xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="scale">1</xsl:param>
  <xsl:param xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="style.background-color">#A0A0A0</xsl:param>
  <xsl:param xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="presentation.page.display">1</xsl:param>
  <xsl:param xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="presentation.notes.display">0</xsl:param>
  <xsl:param xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="CSS.debug">0</xsl:param>
  <xsl:variable xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="linebreak">
    <xsl:text>
</xsl:text>
  </xsl:variable>
  <xsl:template name="length-magnitude">
		<xsl:param name="length" select="'0pt'"/>
			<xsl:choose>
				<xsl:when test="string-length($length) = 0"/>
				<xsl:when test="      substring($length,1,1) = '-' or      substring($length,1,1) = '0' or      substring($length,1,1) = '1' or      substring($length,1,1) = '2' or      substring($length,1,1) = '3' or      substring($length,1,1) = '4' or      substring($length,1,1) = '5' or      substring($length,1,1) = '6' or      substring($length,1,1) = '7' or      substring($length,1,1) = '8' or      substring($length,1,1) = '9' or      substring($length,1,1) = '.'"> 
				<xsl:value-of select="substring($length,1,1)"/>
				<xsl:call-template name="length-magnitude"> 
					<xsl:with-param name="length" select="substring($length,2)"/> 
				</xsl:call-template>
			</xsl:when> 
		</xsl:choose> 
	</xsl:template>
  <xsl:template name="length-normalize">
		<xsl:param name="length" select="'0pt'"/>
		<xsl:param name="pixels.per.inch" select="72"/>
		<xsl:param name="unit" select="'pt'"/>
		
		<xsl:variable name="magnitude">
			<xsl:call-template name="length-magnitude">
				<xsl:with-param name="length" select="$length"/>
			</xsl:call-template>
		</xsl:variable>
		
		<xsl:variable name="units">
			<xsl:value-of select="substring($length, string-length($magnitude)+1)"/>
		</xsl:variable>
		
		<xsl:choose>
			<xsl:when test="$units = '' and $magnitude=''">
				<xsl:value-of select="0"/>
				<xsl:value-of select="$unit"/>
			</xsl:when>
			<xsl:when test="$units = ''">
				<xsl:value-of select="$magnitude"/>
				<xsl:value-of select="$unit"/>
			</xsl:when>
			<xsl:when test="$units = 'em'">
				<xsl:value-of select="$magnitude * 12 * $scale"/>
				<xsl:value-of select="$unit"/>
			</xsl:when>
			<xsl:when test="$units = '%'">
				<xsl:value-of select="$magnitude * $scale"/>
				<xsl:text>%</xsl:text>
			</xsl:when>
			<xsl:when test="$units = 'px'">
				<xsl:value-of select="$magnitude div $pixels.per.inch * 72.0 * $scale"/>
				<xsl:value-of select="$unit"/>
			</xsl:when>
			<xsl:when test="$units = 'pt'">
				<xsl:value-of select="$magnitude * $scale"/>
				<xsl:value-of select="$unit"/>
			</xsl:when>
			<xsl:when test="$units = 'cm'">
				<xsl:value-of select="$magnitude * 28.45 * $scale"/>
				<xsl:value-of select="$unit"/>
			</xsl:when>
			<xsl:when test="$units = 'mm'">
				<xsl:value-of select="$magnitude * 28.45 * $scale * 10"/>
				<xsl:value-of select="$unit"/>
			</xsl:when>
			<!--
			<xsl:when test="$units = 'mm'">
				<xsl:value-of select="$magnitude div 25.4 * 72.0"/>
			</xsl:when>
			<xsl:when test="$units = 'in'">
				<xsl:value-of select="$magnitude * 72.0"/>
			</xsl:when>
			<xsl:when test="$units = 'pc'">
				<xsl:value-of select="$magnitude * 12.0"/>
			</xsl:when>
			<xsl:when test="$units = 'px'">
				<xsl:value-of select="$magnitude div $pixels.per.inch * 72.0"/>
			</xsl:when>
			-->
			<xsl:otherwise>
				<xsl:message>
					<xsl:text>Unrecognized unit of measure: </xsl:text>
					<xsl:value-of select="$units"/>
					<xsl:text>.</xsl:text>
				</xsl:message>
			</xsl:otherwise>
		</xsl:choose>
		
	</xsl:template>
  <xsl:template name="add_id">
		<xsl:attribute name="id">
			
			<xsl:value-of select="name()"/>
			
			<xsl:text>-</xsl:text>
			
			<xsl:choose>
				<xsl:when test="@id">
					<xsl:value-of select="@id"/>
				</xsl:when>
				<xsl:when test="@draw:name">
					<xsl:text>draw:name_</xsl:text><xsl:value-of select="@draw:name"/>
				</xsl:when>
				<xsl:when test="@table:name">
					<xsl:text>table:name_</xsl:text><xsl:value-of select="@table:name"/>
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="generate-id()"/>
				</xsl:otherwise>
			</xsl:choose>
			
		</xsl:attribute>
	</xsl:template>
  <xsl:template name="find-padding-value">
		<xsl:param name="name" select="'right'"/>
		<xsl:param name="node" select="."/>
		
		<!-- find, what is style parrent to this element -->
		<xsl:variable name="parent" select="$node/@style:parent-style-name | $node/@draw:style-name"/>
		
		<xsl:choose>
			<xsl:when test="$name='top' and $node/style:graphic-properties/@fo:padding-top">
				<xsl:value-of select="$node/style:graphic-properties/@fo:padding-top"/>
			</xsl:when>
			<xsl:when test="$name='bottom' and $node/style:graphic-properties/@fo:padding-bottom">
				<xsl:value-of select="$node/style:graphic-properties/@fo:padding-bottom"/>
			</xsl:when>
			<xsl:when test="$name='left' and $node/style:graphic-properties/@fo:padding-left">
				<xsl:value-of select="$node/style:graphic-properties/@fo:padding-left"/>
			</xsl:when>
			<xsl:when test="$name='right' and $node/style:graphic-properties/@fo:padding-right">
				<xsl:value-of select="$node/style:graphic-properties/@fo:padding-right"/>
			</xsl:when>
			<xsl:when test="$parent">
				<xsl:call-template name="find-padding-value">
					<xsl:with-param name="name" select="$name"/>
					<xsl:with-param name="node" select="//style:style[@style:name=$parent]"/>
				</xsl:call-template>
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
		
	</xsl:template>
  <xsl:template match="/office:document">
		<xsl:if test="not($param_css_only)">
		<html>
			<head>
				<!-- meta must be first -->
				<xsl:apply-templates select="office:document-meta"/>
				<!-- must be second -->
				<xsl:apply-templates select="office:document-styles"/>
			</head>
			<!-- body must be after head -->
			<body>
				<xsl:apply-templates select="office:document-content"/>
			</body>
		</html>
		</xsl:if>
		<xsl:if test="$param_css_only">
			<xsl:call-template name="document-styles-css"/>
		</xsl:if>
	</xsl:template>
  <xsl:template match="office:document-styles">
		<xsl:call-template name="document-styles"/>
	</xsl:template>
  <xsl:template match="office:document-meta">
		<xsl:apply-templates/>
	</xsl:template>
  <xsl:template match="office:document-content">
		<xsl:apply-templates/>
	</xsl:template>
  <xsl:template match="office:body">
		<xsl:apply-templates/>
	</xsl:template>
  <xsl:template match="office:document-content/office:automatic-styles"/>
  <xsl:template name="document-styles">
		<xsl:if test="not($param_no_css)">
		<style>
			<xsl:call-template name="document-styles-css"/>
		</style>
		</xsl:if>
	</xsl:template>
  <xsl:template name="document-styles-css">
		/* office:document-styles begin */
		html
		{
			font-family: Verdana, SunSans-Regular, Sans-Serif;
			font-size: <xsl:value-of select="$scale * 14"/>pt;
		}
		@media print
		{
			html
			{
			}
		}
			@media screen
		{
			html
			{
				background-color: <xsl:value-of select="$style.background-color"/>;
				margin: 1.5em;
				position: absolute;
			}
			body
			{
				position: absolute;
			}
		}
		table
		{
			border: thin solid gray;
			border-collapse: collapse;
			empty-cells: show;
			font-size: 10pt;
			table-layout: fixed;
		}
		td
		{
			border: thin solid gray;
			vertical-align: bottom;
		}
		.cell_string
		{
			text-align: left;
		}
		.cell_time
		{
			text-align: right;
		}
		p
		{
			margin-top: 0;
			margin-bottom: 0;
		}
		.page-break
		{
			margin: 1em;
		}
		
		.page_table {border: 0;}
		.page_table tr {border: 0;}
		.page_table td {border: 0; padding-right:3em; vertical-align:top;}
		
		.page
		{
			background-color: white;
			border-left: 1px solid black;
			border-right: 2px solid black;
			border-top: 1px solid black;
			border-bottom: 2px solid black;
		}
		
		<xsl:if test="//office:spreadsheet">
			<xsl:text>
		td p
		{
			max-height: 2.5ex;
			overflow: hidden;
		}
		td p:hover
		{
			max-height: none;
		}
    	    </xsl:text>
		</xsl:if>

		<xsl:apply-templates select="//office:document-styles/*"/>
		/* office:document-styles end */
		/* office:automatic-styles begin */
		<xsl:apply-templates select="//office:document-content/office:automatic-styles/*"/>

		/* office:automatic-styles end */
	</xsl:template>
  <xsl:template match="office:styles">
		<xsl:text>/* office:styles begin */</xsl:text>
		<xsl:value-of select="$linebreak"/>
		<xsl:apply-templates/>
		<xsl:text>/* office:styles end */</xsl:text>
	</xsl:template>
  <xsl:template match="office:automatic-styles">
		<xsl:text>/* office:automatic-styles begin */</xsl:text>
		<xsl:apply-templates/>
		<xsl:text>/* office:automatic-styles end */</xsl:text>
	</xsl:template>
  <xsl:template match="office:master-styles">
		<xsl:text>/* office:master-styles begin */</xsl:text>
		<xsl:apply-templates/>
		<xsl:text>/* office:master-styles end */</xsl:text>
	</xsl:template>
  <xsl:template match="@*" mode="CSS-attr"/>
  <xsl:template match="   style:drawing-page-properties|   style:page-layout-properties|   style:paragraph-properties|   style:text-properties|   style:graphic-properties|   style:table-properties|   style:table-column-properties|   style:table-cell-properties|   style:table-row-properties">

		<xsl:if test="$CSS.debug=1">
			<xsl:value-of select="$linebreak"/>
			<xsl:text>/* </xsl:text>
			<xsl:value-of select="name()"/>
			<xsl:text> begin */</xsl:text>
		</xsl:if>

		<xsl:apply-templates mode="CSS-attr" select="@*"/>
		<xsl:apply-templates mode="CSS-attr" select="*"/>

		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* </xsl:text>
			<xsl:value-of select="name()"/>
			<xsl:text> end */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>

	</xsl:template>
  <xsl:template match="@style:parent-style-name" mode="CSS-attr">
		<xsl:variable name="style-name" select="."/>

		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* @style:parent-style-name '</xsl:text>
			<xsl:value-of select="$style-name"/>
			<xsl:text>' begin */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>

		<xsl:apply-templates select="//style:style[@style:name=$style-name]" mode="CSS-attr"/>

		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* @style:parent-style-name '</xsl:text>
			<xsl:value-of select="$style-name"/>
			<xsl:text>' end */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>

	</xsl:template>
  <xsl:template name="class">
		<xsl:param name="prepend_style" select="''"/>
		<xsl:variable name="class">

			<xsl:if test="$prepend_style != ''">
				<xsl:value-of select="$prepend_style"/><xsl:text> </xsl:text>
			</xsl:if>

			<!-- order by priority -->

			<xsl:if test="@draw:master-page-name">
				<xsl:text>masterpage_</xsl:text>
				<xsl:value-of select="@draw:master-page-name"/>
				<xsl:text> </xsl:text>
			</xsl:if>
			
			<xsl:if test="name()='presentation:notes' and ../@draw:master-page-name">
				<xsl:text>masterpage_</xsl:text>
				<xsl:value-of select="../@draw:master-page-name"/>
				<xsl:text>_notes </xsl:text>
			</xsl:if>
			
			<!-- default of family -->
			<xsl:choose>
				<xsl:when test="name()='draw:frame'">
					<xsl:text>_graphic </xsl:text>
				</xsl:when>
				<xsl:when test="name()='table:table-cell' and @office:value-type='string'">
					<xsl:text>cell_string </xsl:text>
				</xsl:when>
				<xsl:when test="name()='table:table-cell' and @office:value-type='time'">
					<xsl:text>cell_time </xsl:text>
				</xsl:when>
				<xsl:otherwise/>
			</xsl:choose>

			<xsl:choose>
				<xsl:when test="name()='text:span'">
					<xsl:if test="@text:style-name">
						<xsl:text>text_</xsl:text><xsl:value-of select="@text:style-name"/><xsl:text> </xsl:text>
					</xsl:if>
				</xsl:when>
				<xsl:otherwise>
					<xsl:if test="@text:style-name">
						<xsl:text>paragraph_</xsl:text><xsl:value-of select="@text:style-name"/><xsl:text> </xsl:text>
					</xsl:if>
				</xsl:otherwise>
			</xsl:choose>

			<xsl:if test="@table:style-name">
				<xsl:choose>
					<xsl:when test="name()='table:table-column'">
						<xsl:text>table-column_</xsl:text>
					</xsl:when>
					<xsl:when test="name()='table:table-row'">
						<xsl:text>table-row_</xsl:text>
					</xsl:when>
					<xsl:when test="name()='table:table-cell'">
						<xsl:text>table-cell_</xsl:text>
					</xsl:when>
					<xsl:otherwise>
						<xsl:text>table_</xsl:text>
<!-- void42: possible bug here -->
<!-- due to different style naming with "class" template above -->
					</xsl:otherwise>
				</xsl:choose>
				<xsl:value-of select="@table:style-name"/>
				<xsl:text> </xsl:text>
			</xsl:if>

			<xsl:if test="@presentation:style-name">
				<xsl:text>presentation_</xsl:text>
				<xsl:value-of select="@presentation:style-name"/>
				<xsl:if test="ancestor::style:master-page">
					<xsl:text>_master</xsl:text>
				</xsl:if>
				<xsl:text> </xsl:text>
			</xsl:if>

			<!--
				The draw:text-style-name attribute specifies a style for the drawing shape that
				is used to format the text that can be added to this shape.
				The value of this attribute is the name of a <style:style> element with a family
				value of paragraph.
			-->
			<xsl:if test="@draw:text-style-name">
				<xsl:text>paragraph_</xsl:text>
				<xsl:value-of select="@draw:text-style-name"/>
				<xsl:text> </xsl:text>
			</xsl:if>

			<xsl:if test="@draw:style-name">
				<xsl:choose>
					<xsl:when test="local-name()='page'">
						<xsl:text>drawing-page_</xsl:text>
					</xsl:when>
					<xsl:when test="local-name()='notes'">
						<xsl:text>drawing-page_</xsl:text>
					</xsl:when>
					<xsl:otherwise>
						<xsl:text>graphic_</xsl:text>
					</xsl:otherwise>
				</xsl:choose>
				<xsl:value-of select="@draw:style-name"/>
				<xsl:text> </xsl:text>
			</xsl:if>

		</xsl:variable>

		<xsl:if test="$class != ''">
			<xsl:attribute name="class">
				<xsl:value-of select="translate($class,'.','_')"/>
			</xsl:attribute>
		</xsl:if>

	</xsl:template>
  <xsl:template match="number:number-style"/>
  <xsl:template match="number:currency-style"/>
  <xsl:template match="number:time-style"/>
  <xsl:template match="style:default-style">
		
		<xsl:value-of select="$linebreak"/>
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* style:default-style @style:family='</xsl:text>
			<xsl:value-of select="@style:family"/>
			<xsl:text>' begin */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
		<xsl:choose>
			<xsl:when test="@style:family='paragraph'">
				<xsl:text>p</xsl:text>
			</xsl:when>
			<xsl:when test="@style:family='table'">
				<xsl:text>table</xsl:text>
			</xsl:when>
			<xsl:when test="@style:family='table-cell'">
				<xsl:text>td</xsl:text>
			</xsl:when>
			<xsl:when test="@style:family='table-row'">
				<xsl:text>tr</xsl:text>
			</xsl:when>
			<xsl:otherwise>
				<xsl:text>._</xsl:text><xsl:value-of select="@style:family"/>
			</xsl:otherwise>
		</xsl:choose>
		
		<xsl:text>/* family default */</xsl:text>
		
		<xsl:value-of select="$linebreak"/>
		<xsl:text>{</xsl:text>
			<xsl:call-template name="style_default_default" mode="CSS-attr"/>
			<xsl:apply-templates/>
		<xsl:text>}</xsl:text>
		<xsl:value-of select="$linebreak"/>
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* style:default-style @style:family='</xsl:text>
			<xsl:value-of select="@style:family"/>
			<xsl:text>' end */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
	</xsl:template>
  <xsl:template name="style_default_default" mode="CSS-attr">
	
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* default_default begin */</xsl:text>
		</xsl:if>
		
		<xsl:choose>
			<xsl:when test="@style:family='graphic'">
				<xsl:text>vertical-align: middle;</xsl:text>
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* default_default end */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
	</xsl:template>
  <xsl:template name="style_standard_default" mode="CSS-attr">
	
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* standard_default begin */</xsl:text>
		</xsl:if>
		
		<xsl:choose>
			<xsl:when test="name()='style:page-layout'">
				
				<xsl:text>border-left: 1px solid gray;</xsl:text>
				<xsl:text>border-right: 1px solid gray;</xsl:text>
				<xsl:text>border-top: 1px solid gray;</xsl:text>
				<xsl:text>border-bottom: 1px solid gray;</xsl:text>
				
				<xsl:if test="//office:text|//office:spreadsheet">
					<xsl:text>background-color: white;</xsl:text>
				</xsl:if>
			</xsl:when>
			<xsl:when test="@style:family='table'">
				<!--<xsl:text>border: 0pt solid black;</xsl:text>-->
				<xsl:text>padding: 0pt;</xsl:text>
				<xsl:text>margin: 0pt;</xsl:text>
			</xsl:when>
			<xsl:when test="@style:family='paragraph'">
				<!--<xsl:text>text-align: left;</xsl:text>-->
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* standard_default end */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
	</xsl:template>
  <xsl:template match="style:style">
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* style:style @style:family='</xsl:text>
			<xsl:value-of select="@style:family"/>
			<xsl:text>' begin */</xsl:text>
		</xsl:if>
		
		<!-- classic style -->
		
		<xsl:value-of select="$linebreak"/>
		<xsl:text>.</xsl:text>
		<xsl:value-of select="@style:family"/>
		<xsl:text>_</xsl:text>
		<xsl:value-of select="translate(@style:name,'.','_')"/>
		<xsl:value-of select="$linebreak"/>
		<xsl:text>{</xsl:text>
		
		<xsl:if test="$CSS.debug=1">
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
		<xsl:call-template name="style_standard_default" mode="CSS-attr"/>
		<xsl:apply-templates select="@*" mode="CSS-attr"/>
		<xsl:apply-templates/>
		
		<xsl:text>}</xsl:text>
		<xsl:value-of select="$linebreak"/>
		
		<!-- special style for master elements -->
		<!--
			elements in master-page is affected only with styles defined
			in styles.xml, not with styles in content.xml
		-->
		<xsl:if test="ancestor::office:document-styles and @style:family='presentation'">
		
			<xsl:text>.</xsl:text>
			<xsl:value-of select="@style:family"/>
			<xsl:text>_</xsl:text>
			<xsl:value-of select="translate(@style:name,'.','_')"/>
			<xsl:text>_master</xsl:text>
			<xsl:value-of select="$linebreak"/>
			<xsl:text>{</xsl:text>
			
			<xsl:if test="$CSS.debug=1">
				<xsl:value-of select="$linebreak"/>
			</xsl:if>
			
			<xsl:call-template name="style_standard_default" mode="CSS-attr"/>
			<xsl:apply-templates select="@*" mode="CSS-attr"/>
			<xsl:apply-templates/>
			
			<xsl:text>}</xsl:text>
			<xsl:value-of select="$linebreak"/>
			
		</xsl:if>
		
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* style:style @style:family='</xsl:text>
			<xsl:value-of select="@style:family"/>
			<xsl:text>' end */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
	</xsl:template>
  <xsl:template match="style:style" mode="CSS-attr">
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* style:style CSS-attr @style:family='</xsl:text>
			<xsl:value-of select="@style:family"/>
			<xsl:text>' begin */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
		<xsl:apply-templates select="@*" mode="CSS-attr"/>
		<xsl:apply-templates/>
			
		<xsl:if test="$CSS.debug=1">
			<xsl:value-of select="$linebreak"/>
			<xsl:text>/* style:style CSS-attr @style:family='</xsl:text>
			<xsl:value-of select="@style:family"/>
			<xsl:text>' end */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
	</xsl:template>
  <xsl:template match="style:master-page">
		<xsl:variable name="page-layout-name" select="@style:page-layout-name"/>
		<xsl:variable name="page-layout-notes-name" select="presentation:notes/@style:page-layout-name"/>
		
		<xsl:text>@media screen</xsl:text><xsl:value-of select="$linebreak"/>
		<xsl:text>{</xsl:text><xsl:value-of select="$linebreak"/>
			<xsl:text>.masterpage_</xsl:text><xsl:value-of select="@style:name"/><xsl:value-of select="$linebreak"/>
			<xsl:text>{</xsl:text><xsl:value-of select="$linebreak"/>
			<xsl:apply-templates select="//style:page-layout[@style:name=$page-layout-name]" mode="CSS-attr"/>
			<xsl:value-of select="$linebreak"/>
			<xsl:text>}</xsl:text><xsl:value-of select="$linebreak"/>
		<xsl:value-of select="$linebreak"/>
		<xsl:text>}</xsl:text><xsl:value-of select="$linebreak"/>
		
		<xsl:text>@media print</xsl:text><xsl:value-of select="$linebreak"/>
		<xsl:text>{</xsl:text><xsl:value-of select="$linebreak"/>
			<xsl:text>.masterpage_</xsl:text><xsl:value-of select="@style:name"/><xsl:value-of select="$linebreak"/>
			<xsl:text>{</xsl:text><xsl:value-of select="$linebreak"/>
			<xsl:text>width: 100%;</xsl:text><xsl:value-of select="$linebreak"/>
			<xsl:text>}</xsl:text><xsl:value-of select="$linebreak"/>
		<xsl:value-of select="$linebreak"/>
		<xsl:text>}</xsl:text><xsl:value-of select="$linebreak"/>
		
		<xsl:if test="presentation:notes">
		
			<xsl:text>@media screen</xsl:text><xsl:value-of select="$linebreak"/>
			<xsl:text>{</xsl:text><xsl:value-of select="$linebreak"/>
				<xsl:text>.masterpage_</xsl:text><xsl:value-of select="@style:name"/>_notes<xsl:value-of select="$linebreak"/>
				<xsl:text>{</xsl:text><xsl:value-of select="$linebreak"/>
				<xsl:apply-templates select="//style:page-layout[@style:name=$page-layout-notes-name]" mode="CSS-attr"/>
				<xsl:value-of select="$linebreak"/>
				<xsl:text>}</xsl:text><xsl:value-of select="$linebreak"/>
			<xsl:value-of select="$linebreak"/>
			<xsl:text>}</xsl:text><xsl:value-of select="$linebreak"/>
			
			<xsl:text>@media print</xsl:text><xsl:value-of select="$linebreak"/>
			<xsl:text>{</xsl:text><xsl:value-of select="$linebreak"/>
				<xsl:text>.masterpage_</xsl:text><xsl:value-of select="@style:name"/>_notes<xsl:value-of select="$linebreak"/>
				<xsl:text>{</xsl:text><xsl:value-of select="$linebreak"/>
				<xsl:text>width: 100%;</xsl:text><xsl:value-of select="$linebreak"/>
				<xsl:text>}</xsl:text><xsl:value-of select="$linebreak"/>
			<xsl:value-of select="$linebreak"/>
			<xsl:text>}</xsl:text><xsl:value-of select="$linebreak"/>
			
		</xsl:if>
		
	</xsl:template>
  <xsl:template match="style:footer"/>
  <xsl:template match="style:header"/>
  <xsl:template match="style:page-layout"/>
  <xsl:template match="style:handout-master"/>
  <xsl:template match="style:page-layout" mode="CSS-attr">
		/* style:page-layout begin */
		<xsl:call-template name="style_standard_default" mode="CSS-attr"/>
		<xsl:apply-templates select="@*" mode="CSS-attr"/>
		<xsl:apply-templates/>
		/* style:page-layout end */
	</xsl:template>
  <xsl:template match="@fo:page-width" mode="CSS-attr">
		<xsl:text>width: </xsl:text>
		<xsl:variable name="width">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="length" select="."/>
				<xsl:with-param name="unit" select="''"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="margin-right">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="length" select="../@fo:margin-right"/>
				<xsl:with-param name="unit" select="''"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="margin-left">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="length" select="../@fo:margin-left"/>
				<xsl:with-param name="unit" select="''"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="width_normal" select="$width - $margin-right - $margin-left"/>
		<xsl:value-of select="$width_normal"/><xsl:text>pt</xsl:text>
		<xsl:text>; </xsl:text>
	</xsl:template>
  <xsl:template match="@fo:page-height" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test="//office:presentation">
				<xsl:text>height: </xsl:text>
			</xsl:when>
			<xsl:otherwise>
				<xsl:text>min-height: </xsl:text>
			</xsl:otherwise>
		</xsl:choose>
		
		<xsl:variable name="height">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="length" select="."/>
				<xsl:with-param name="unit" select="''"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="margin-top">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="length" select="../@fo:margin-top"/>
				<xsl:with-param name="unit" select="''"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="margin-bottom">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="length" select="../@fo:margin-bottom"/>
				<xsl:with-param name="unit" select="''"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="height_normal" select="$height - $margin-top - $margin-bottom"/>
		<xsl:value-of select="$height_normal"/><xsl:text>pt</xsl:text>
		<xsl:text>; </xsl:text>
	</xsl:template>
  <xsl:template match="@table:align" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'left'">
				<xsl:text>margin-left: 0px; </xsl:text>
				<xsl:text>margin-right: auto; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'right'">
				<xsl:text>margin-left: auto; </xsl:text>
				<xsl:text>margin-right: 0px; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'center'">
				<xsl:text>margin-left: auto; </xsl:text>
				<xsl:text>margin-right: auto; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'margin'">
				<xsl:text>margin-left: 0px; </xsl:text>
				<xsl:text>margin-right: 0px; </xsl:text>
				<xsl:text>width: 100%; </xsl:text>
			</xsl:when>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@table:border-model" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'collapsing'">
				<xsl:text>border-collapse: collapse; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'separating'">
				<xsl:text>border-collapse: separate; </xsl:text>
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@table:display" mode="CSS-attr">
		<!-- could only be in style:table-properties style description -->
		<xsl:if test="parent::style:table-properties">
			<xsl:if test=". = 'false'">
				<xsl:text>display: none; </xsl:text>
			</xsl:if>
		</xsl:if>
	</xsl:template>
  <xsl:template match="@style:column-width" mode="CSS-attr">
		<xsl:text>width: </xsl:text>
		<xsl:call-template name="normalized-value"/>
	</xsl:template>
  <xsl:template match="@style:horizontal-pos" mode="CSS-attr">
		<xsl:choose>
			<!-- We can't support the others until we figure out pagination. -->
			<xsl:when test=".='left'">
				<xsl:text>margin-left: 0; margin-right: auto; </xsl:text>
			</xsl:when>
			<xsl:when test=".='right'">
				<xsl:text>margin-left: auto; margin-right: 0; </xsl:text>
			</xsl:when>
			<xsl:when test=".='center'">
				<xsl:text>margin-left: auto; margin-right: auto;</xsl:text>
			</xsl:when>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@style:rel-width" mode="CSS-attr">
		<xsl:text>width: </xsl:text><xsl:value-of select="."/><xsl:text>%; </xsl:text>
	</xsl:template>
  <xsl:template match="@style:row-height" mode="CSS-attr">
		<xsl:text>height: </xsl:text>
		<xsl:call-template name="normalized-value"/>
	</xsl:template>
  <xsl:template match="@style:min-row-height" mode="CSS-attr">
		<xsl:text>min-height: </xsl:text>
		<xsl:call-template name="normalized-value"/>
	</xsl:template>
  <xsl:template match="@style:text-align-source" mode="CSS-attr">
		<xsl:if test=". = 'value-type'">
			<xsl:text>text-align: right !important; </xsl:text>
		</xsl:if>
	</xsl:template>
  <xsl:template match="@draw:fill" mode="CSS-attr">
		<xsl:if test="not(@draw:fill-color)">
			<xsl:text>background-color: transparent;</xsl:text>
		</xsl:if>
	</xsl:template>
  <xsl:template match="@draw:fill-color" mode="CSS-attr">
		
		<xsl:variable name="parent" select="../../@style:parent-style-name"/>
		
		<!-- defined default @draw:fill -->
		<xsl:variable name="default">
			<xsl:choose>
				<!-- if default @draw-fill for graphic is defined in parent style -->
				<xsl:when test="//style:style[@style:name=$parent]/style:graphic-properties/@draw:fill">
					<!-- use it -->
					<xsl:value-of select="//style:style[@style:name=$parent]/style:graphic-properties/@draw:fill"/>
				</xsl:when>
				<!-- if default @draw-fill for graphic is defined -->
				<xsl:when test="//style:default-style[@style:family='graphic']/style:graphic-properties/@draw:fill">
					<!-- use it -->
					<xsl:value-of select="//style:default-style[@style:family='graphic']/style:graphic-properties/@draw:fill"/>
				</xsl:when>
				<xsl:otherwise>
					<xsl:text>solid</xsl:text>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		
		<!--
		<xsl:message>
			<xsl:text>@draw:fill-color </xsl:text>
			<xsl:text>parent:</xsl:text><xsl:value-of select="$parent"/><xsl:text> </xsl:text>
			<xsl:text>default:</xsl:text><xsl:value-of select="$default"/><xsl:text> </xsl:text>
		</xsl:message>
		-->
		
		<xsl:choose>
			<xsl:when test="../@draw:fill='solid'">
				<xsl:text>background-color: </xsl:text>
				<xsl:value-of select="../@draw:fill-color"/><xsl:text>; </xsl:text>
			</xsl:when>
			<xsl:when test="../@draw:fill='none'">
				<xsl:text>background-color: transparent;</xsl:text>
			</xsl:when>
			<!--
				OOo Issue #: 72134
				Specification at 14.2 Default Styles
				"These defaults are  used if a formatting property is neither specified
				by an automatic nor a common style."
				If you do not specify a style:default-style, the application will use its own
				defaults for properties that have no specified default. OOo.org as an
				application has a default of solid for the property draw:fill-style.
				Application defaults are things that can change from application to application
				and also from version to version, thats why we added the default styles. All
				applications creating OpenDocument files should use them and define their
				defaults for each property that has no specified default, if not, the results
				are unpredictable.
			-->
			<xsl:when test="not(../@draw:fill) and $default='solid' and ancestor::office:document-styles">
				<xsl:text>background-color: </xsl:text>
				<xsl:value-of select="../@draw:fill-color"/><xsl:text>; </xsl:text>
			</xsl:when>
			<xsl:otherwise>
				<xsl:text>background-color: transparent; </xsl:text>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@draw:stroke" mode="CSS-attr">
		<xsl:if test="not(@svg:stroke-color)">
			<xsl:text>border-color: transparent;</xsl:text>
		</xsl:if>
	</xsl:template>
  <xsl:template match="@svg:stroke-color" mode="CSS-attr">
		
		<xsl:variable name="parent" select="../../@style:parent-style-name"/>
		
		<!-- defined default @draw:stroke -->
		<xsl:variable name="default">
			<xsl:choose>
				<!-- if default @draw-stroke for graphic is defined in parent style -->
				<xsl:when test="//style:style[@style:name=$parent]/style:graphic-properties/@draw:stroke">
					<!-- use it -->
					<xsl:value-of select="//style:style[@style:name=$parent]/style:graphic-properties/@draw:stroke"/>
				</xsl:when>
				<!-- if default @draw-stroke for graphic is defined -->
				<xsl:when test="//style:default-style[@style:family='graphic']/style:graphic-properties/@draw:stroke">
					<!-- use it -->
					<xsl:value-of select="//style:default-style[@style:family='graphic']/style:graphic-properties/@draw:fill"/>
				</xsl:when>
				<xsl:otherwise>
					<xsl:text>solid</xsl:text>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		
		<xsl:variable name="width">
			<xsl:choose>
				<xsl:when test="../@svg:stroke-width">
					<xsl:value-of select="../@svg:stroke-width"/>
				</xsl:when>
				<xsl:otherwise>
					<xsl:text>1pt</xsl:text>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		
		<xsl:choose>
			<xsl:when test="../@draw:stroke='solid'">
				<xsl:text>border-style: solid; border-width: </xsl:text>
				<xsl:value-of select="$width"/>
				<xsl:text>; border-color: </xsl:text>
				<xsl:value-of select="../@svg:stroke-color"/><xsl:text>; </xsl:text>
			</xsl:when>
			<xsl:when test="../@draw:stroke='dash'">
				<xsl:text>border-style: dashed; border-width: </xsl:text>
				<xsl:value-of select="$width"/>
				<xsl:text>; border-color: </xsl:text>
				<xsl:value-of select="../@svg:stroke-color"/><xsl:text>; </xsl:text>
			</xsl:when>
			<xsl:when test="../@draw:stroke='none'">
				<xsl:text>border-size: 0pt;</xsl:text>
			</xsl:when>
			<xsl:when test="not(../@draw:stroke) and $default='solid' and ancestor::office:document-styles">
				<xsl:text>border-style: solid; border-width: </xsl:text>
				<xsl:value-of select="$width"/>
				<xsl:text>; border-color: </xsl:text>
				<xsl:value-of select="../@svg:stroke-color"/><xsl:text>; </xsl:text>
			</xsl:when>
			<xsl:otherwise>
				<xsl:text>border-color: transparent; </xsl:text>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@svg:width" mode="CSS-attr">
		<xsl:variable name="width">
			<xsl:call-template name="normalized-just-value"/>
		</xsl:variable>
		<xsl:variable name="padding-right">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="unit" select="''"/>
				<xsl:with-param name="length">
					<xsl:call-template name="find-padding-value">
						<xsl:with-param name="name" select="'right'"/>
						<xsl:with-param name="node" select=".."/>
					</xsl:call-template>
				</xsl:with-param>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="padding-left">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="unit" select="''"/>
				<xsl:with-param name="length">
					<xsl:call-template name="find-padding-value">
						<xsl:with-param name="name" select="'left'"/>
						<xsl:with-param name="node" select=".."/>
					</xsl:call-template>
				</xsl:with-param>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="width-recomputed" select="$width - $padding-left - $padding-right"/>
		<xsl:text>width: </xsl:text><xsl:value-of select="$width-recomputed"/><xsl:text>pt; </xsl:text>
	</xsl:template>
  <xsl:template match="@svg:height" mode="CSS-attr">
		<xsl:variable name="height">
			<xsl:call-template name="normalized-just-value"/>
		</xsl:variable>
		<xsl:variable name="padding-top">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="unit" select="''"/>
				<xsl:with-param name="length">
					<xsl:call-template name="find-padding-value">
						<xsl:with-param name="name" select="'top'"/>
						<xsl:with-param name="node" select=".."/>
					</xsl:call-template>
				</xsl:with-param>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="padding-bottom">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="unit" select="''"/>
				<xsl:with-param name="length">
					<xsl:call-template name="find-padding-value">
						<xsl:with-param name="name" select="'bottom'"/>
						<xsl:with-param name="node" select=".."/>
					</xsl:call-template>
				</xsl:with-param>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="height-recomputed" select="$height - $padding-top - $padding-bottom"/>
		<xsl:text>height: </xsl:text><xsl:value-of select="$height-recomputed"/><xsl:text>pt; </xsl:text>
	</xsl:template>
  <xsl:template match="@svg:x" mode="CSS-attr">
		<xsl:variable name="x">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="unit" select="''"/>
				<xsl:with-param name="length" select="."/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="page-layout-name" select="//style:master-page/@style:page-layout-name"/>
		<xsl:variable name="margin-left">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="unit" select="''"/>
				<xsl:with-param name="length" select="       //style:page-layout[@style:name=$page-layout-name]       /style:page-layout-properties       /@fo:margin-left"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:text>margin-left: </xsl:text>
		<xsl:value-of select="$x - $margin-left"/><xsl:text>pt; </xsl:text>
	</xsl:template>
  <xsl:template match="@svg:y" mode="CSS-attr">
		<xsl:variable name="y">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="unit" select="''"/>
				<xsl:with-param name="length" select="."/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="page-layout-name" select="//style:master-page/@style:page-layout-name"/>
		<xsl:variable name="margin-top">
			<xsl:call-template name="length-normalize">
				<xsl:with-param name="unit" select="''"/>
				<xsl:with-param name="length" select="       //style:page-layout[@style:name=$page-layout-name]       /style:page-layout-properties       /@fo:margin-top"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:text>margin-top: </xsl:text>
		<xsl:value-of select="$y - $margin-top"/><xsl:text>pt; </xsl:text>
	</xsl:template>
  <xsl:template match="@style:width|@style:height|@fo:width|@fo:height" mode="CSS-attr">
		<xsl:call-template name="copy-attr-normalized"/>
	</xsl:template>
  <xsl:template match="@fo:margin-top" mode="CSS-attr">
		<xsl:text>margin-top:</xsl:text>
		<xsl:call-template name="normalized-value"/>
	</xsl:template>
  <xsl:template match="@fo:margin-bottom" mode="CSS-attr">
		<xsl:text>margin-bottom:</xsl:text>
		<xsl:call-template name="normalized-value"/>
	</xsl:template>
  <xsl:template match="@fo:margin-left" mode="CSS-attr">
		<xsl:text>margin-left:</xsl:text>
		<xsl:call-template name="normalized-value"/>
	</xsl:template>
  <xsl:template match="@fo:margin-right" mode="CSS-attr">
		<xsl:text>margin-right:</xsl:text>
		<xsl:call-template name="normalized-value"/>
	</xsl:template>
  <xsl:template match="    @fo:font-name|    @fo:font-family|    @svg:font-family" mode="CSS-attr">
		<xsl:text>font-family: </xsl:text><xsl:value-of select="."/>
		<xsl:text>; </xsl:text>
	</xsl:template>
  <xsl:template match="@style:font-name" mode="CSS-attr">
		<xsl:variable name="style_name" select="."/>
		<xsl:text>font-family: </xsl:text><xsl:value-of select="//style:font-face[@style:name=$style_name]/@svg:font-family"/>
		<xsl:text>; </xsl:text>
	</xsl:template>
  <xsl:template match="    @fo:font-variant|    @fo:font-style|    @fo:font-weight" mode="CSS-attr">
		<xsl:call-template name="copy-attr"/>
	</xsl:template>
  <xsl:template match="    @fo:color|    @fo:background-color" mode="CSS-attr">
		<xsl:call-template name="copy-attr"/>
	</xsl:template>
  <xsl:template match="    @fo:text-indent|    @fo:font-size|    @fo:line-height" mode="CSS-attr">
		<xsl:call-template name="copy-attr-normalized"/>
	</xsl:template>
  <xsl:template match="@fo:text-align" mode="CSS-attr">
		<xsl:value-of select="local-name()"/><xsl:text>: </xsl:text>
		<xsl:choose>
			<xsl:when test=".='start'"><xsl:text>left</xsl:text></xsl:when>
			<xsl:when test=".='end'"><xsl:text>right</xsl:text></xsl:when>
			<xsl:otherwise><xsl:value-of select="."/></xsl:otherwise>
		</xsl:choose>
		<xsl:text>; </xsl:text>
	</xsl:template>
  <xsl:template match="    @style:text-underline-style|    @style:text-underline-type" mode="CSS-attr">
		<xsl:if test="not(.='none')">
			<xsl:text>text-decoration: underline;</xsl:text>
		</xsl:if>
	</xsl:template>
  <xsl:template match="    @fo:border|    @fo:border-top|    @fo:border-bottom|    @fo:border-left|    @fo:border-right" mode="CSS-attr">
		<xsl:call-template name="copy-attr"/>
	</xsl:template>
  <xsl:template match="    @fo:padding|    @fo:padding-top|    @fo:padding-bottom|    @fo:padding-left|    @fo:padding-right" mode="CSS-attr">
		<xsl:call-template name="copy-attr-normalized"/>
	</xsl:template>
  <xsl:template match="@style:may-break-between-rows" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'true'">
				<xsl:text>page-break-inside: auto; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'false'">
				<xsl:text>page-break-inside: avoid; </xsl:text>
			</xsl:when>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@fo:break-before" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'auto'">
				<xsl:text>page-break-before: auto;</xsl:text>
			</xsl:when>
			<xsl:when test=". = 'page'">
				<xsl:text>page-break-before: always;</xsl:text>
			</xsl:when>
			<xsl:when test=". = 'column'">
				<xsl:text>/* page-break-before: column; UNSUPPORTED */</xsl:text>
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@fo:break-after" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'auto'">
				<xsl:text>page-break-after: auto;</xsl:text>
			</xsl:when>
			<xsl:when test=". = 'page'">
				<xsl:text>page-break-after: always;</xsl:text>
			</xsl:when>
			<xsl:when test=". = 'column'">
				<xsl:text>/* page-break-after: column; UNSUPPORTED */</xsl:text>
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@fo:keep-with-next" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'auto'">
				<xsl:text>page-break-after: auto;</xsl:text>
			</xsl:when>
			<xsl:when test=". = 'always'">
				<xsl:text>page-break-after: avoid;</xsl:text>
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@fo:keep-together" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'auto'">
				<xsl:text>page-break-inside: auto; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'always'">
				<xsl:text>page-break-inside: avoid; </xsl:text>
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@fo:wrap-option" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'no-wrap'">
				<xsl:text>white-space: nowrap; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'wrap'">
				<xsl:text>white-space: normal; </xsl:text>
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@style:writing-mode" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'lr-tb' or . = 'lr'">
				<xsl:text>direction: ltr; </xsl:text>
				<xsl:text>writing-mode: lr-tb; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'rl-tb' or . = 'rl'">
				<xsl:text>direction: rtl; </xsl:text>
				<xsl:text>writing-mode: rl-tb; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'tb-rl' or . = 'tb'">
				<xsl:text>direction: rtl; </xsl:text>
				<xsl:text>writing-mode: tb-rl; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'tb-lr'">
				<xsl:text>direction: ltr; </xsl:text>
				<xsl:text>writing-mode: tb-lr; </xsl:text>
			</xsl:when>
			<xsl:when test=". = 'page'">
				<xsl:text>direction: inherit; </xsl:text>
				<xsl:text>writing-mode: inherit; </xsl:text>
			</xsl:when>
			<xsl:otherwise>
				<xsl:call-template name="copy-attr"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="@style:direction" mode="CSS-attr">
		<xsl:choose>
			<xsl:when test=". = 'ltr'">
				<!-- do nothing? -->
			</xsl:when>
			<xsl:when test=". = 'ttb'">
				<!-- no CSS2 way to do it -->
			</xsl:when>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="style:background-image[@xlink:href]" mode="CSS-attr">
		<xsl:if test="../@fo:background-color != 'transparent'">
			<xsl:text>background-image: url('</xsl:text><xsl:value-of select="@xlink:href"/><xsl:text>'); </xsl:text>
			<xsl:choose>
				<!-- do not copy default value -->
				<xsl:when test="@style:repeat and @style:repeat = 'repeat'">
					<xsl:text>background-repeat: repeat;</xsl:text>
				</xsl:when>
				<xsl:when test="@style:repeat = 'no-repeat'">
					<xsl:text>background-repeat: no-repeat;</xsl:text>
				</xsl:when>
				<xsl:when test="@style:repeat = 'stretch'">
					<xsl:text>/* background-repeat: stretch; UNSUPPORTED */ </xsl:text>
				</xsl:when>
			</xsl:choose>
			<xsl:if test="@style:position">
				<xsl:text>background-position: </xsl:text><xsl:value-of select="@style:position"/><xsl:text>; </xsl:text>
			</xsl:if>
		</xsl:if>
	</xsl:template>
  <xsl:template name="copy-attr-normalized" mode="CSS-attr">
		<xsl:value-of select="local-name()"/><xsl:text>:</xsl:text>
		<xsl:call-template name="normalized-value"/>
	</xsl:template>
  <xsl:template name="normalized-value" mode="CSS-attr">
		<xsl:call-template name="length-normalize">
			<xsl:with-param name="length" select="."/>
		</xsl:call-template>
		<xsl:text>; </xsl:text>
	</xsl:template>
  <xsl:template name="normalized-just-value" mode="CSS-attr">
		<xsl:call-template name="length-normalize">
			<xsl:with-param name="length" select="."/>
			<xsl:with-param name="unit" select="''"/>
		</xsl:call-template>
	</xsl:template>
  <xsl:template name="copy-attr" mode="CSS-attr">
		<xsl:value-of select="local-name()"/><xsl:text>:</xsl:text>
		<xsl:value-of select="."/><xsl:text>; </xsl:text>
	</xsl:template>
  <xsl:template match="draw:rect">
		<div>
			<xsl:call-template name="add_id"/>
			<xsl:call-template name="class"/>
			<xsl:attribute name="style">
				<!-- only for debug -->
				<!--<xsl:text>border: 1px solid #888; </xsl:text>-->
				<xsl:choose>
					<xsl:when test="//office:presentation">
						<xsl:text>position: absolute; </xsl:text>
					</xsl:when>
					<xsl:otherwise>
						<xsl:text>position: relative; </xsl:text>
					</xsl:otherwise>
				</xsl:choose>
				<!-- positioning -->
				<xsl:apply-templates select="@*" mode="CSS-attr"/>
			</xsl:attribute>
			<xsl:apply-templates/>
		</div>
	</xsl:template>
  <xsl:template match="draw:page">
		<xsl:choose>
			<xsl:when test="presentation:notes and $presentation.page.display=1 and $presentation.notes.display=1">
				<table class="page_table">
					<tr>
						<td>
							<div class="page">
								<div>
									<xsl:call-template name="add_id"/>
									<xsl:call-template name="class"/>
									<xsl:call-template name="master-page"/>
									<xsl:apply-templates/>
								</div>
							</div>
						</td>
						<td>
							<div class="page">
								<xsl:apply-templates select="presentation:notes" mode="notes"/>
							</div>
						</td>
					</tr>
				</table>
			</xsl:when>
			<xsl:when test="$presentation.page.display=1">
				<div class="page">
					<div>
						<xsl:call-template name="add_id"/>
						<xsl:call-template name="class"/>
						<xsl:call-template name="master-page"/>
						<xsl:apply-templates/>
					</div>
				</div>
			</xsl:when>
			<xsl:when test="presentation:notes and $presentation.notes.display=1">
				<div class="page">
					<xsl:apply-templates select="presentation:notes" mode="notes"/>
				</div>
			</xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
		<div class="page-break"/>
	</xsl:template>
  <xsl:template match="draw:frame">
		<div>
			<xsl:call-template name="add_id"/>
			<xsl:call-template name="class"/>
			<!--
			<xsl:attribute name="class">
				<xsl:text>text_</xsl:text><xsl:value-of select="@draw:text-style-name"/><xsl:text> </xsl:text>
				<xsl:text>presentation_</xsl:text><xsl:value-of select="@presentation:style-name"/><xsl:text>
			</xsl:attribute>
			-->
			<xsl:attribute name="style">
				<!-- only for debug -->
				<!--<xsl:text>border: 1px solid #888; </xsl:text>-->
				<xsl:choose>
					<xsl:when test="//office:presentation">
						<xsl:text>position: absolute; </xsl:text>
					</xsl:when>
					<xsl:otherwise>
						<xsl:text>position: relative; </xsl:text>
					</xsl:otherwise>
				</xsl:choose>
				<!-- positioning -->
				<xsl:apply-templates select="@*" mode="CSS-attr"/>
			</xsl:attribute>
			<xsl:apply-templates/>
		</div>
	</xsl:template>
  <xsl:template match="style:master-page//draw:text-box"/>
  <xsl:template match="draw:text-box">
		<div>
			<xsl:call-template name="add_id"/>
			<xsl:apply-templates/>
		</div>
	</xsl:template>
  <xsl:template match="draw:frame/draw:image">
		<xsl:element name="img">
			<xsl:attribute name="style">
				<!-- Default behaviour -->
				<xsl:text>width: 100%; height: 100%; </xsl:text>
				<xsl:if test="not(../@text:anchor-type='character')">
				<xsl:text>display: block; </xsl:text>
				</xsl:if>
			</xsl:attribute>
		
			<xsl:attribute name="alt">
				<xsl:value-of select="../svg:desc"/>
			</xsl:attribute>
			<xsl:attribute name="src">
				<xsl:value-of select="concat($param_baseuri,@xlink:href)"/>
			</xsl:attribute>
		</xsl:element>
	</xsl:template>
  <xsl:template match="svg:desc"/>
  <xsl:template match="draw:layer-set"/>
  <xsl:template match="office:meta">
		<xsl:comment>office:metadata begin</xsl:comment>
		<xsl:apply-templates select="dc:title"/>
		<xsl:apply-templates select="dc:creator"/>
		<xsl:apply-templates select="dc:date"/>
		<xsl:apply-templates select="dc:language"/>
		<xsl:apply-templates select="dc:description"/>
		<xsl:apply-templates select="meta:keyword"/>
		<xsl:apply-templates select="meta:generator"/>
		<xsl:apply-templates select="meta:document-statistic"/>
		<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8"/>
		<xsl:comment>office:metadata end</xsl:comment>
	</xsl:template>
  <xsl:template match="dc:title">
		<title><xsl:apply-templates/></title>
		<meta name="DC.title" content="{current()}"/>
	</xsl:template>
  <xsl:template match="dc:language">
		<meta http-equiv="content-language" content="{current()}"/>
		<meta name="DC.language" content="{current()}"/>
	</xsl:template>
  <xsl:template match="dc:creator">
		<meta name="author" content="{current()}"/>
		<meta name="DC.creator" content="{current()}"/>
	</xsl:template>
  <xsl:template match="dc:description">
		<meta name="description" content="{current()}"/>
	</xsl:template>
  <xsl:template match="dc:date">
		<meta name="revised" content="{current()}"/>
		<meta name="DC.date" content="{current()}"/>
	</xsl:template>
  <xsl:template match="meta:keyword">
		<meta name="keywords" content="{current()}"/>
	</xsl:template>
  <xsl:template match="meta:generator">
		<meta name="generator" content="{current()}"/>
	</xsl:template>
  <xsl:template match="meta:document-statistic">
		<meta name="meta:page-count" content="{@meta:page-count}"/>
		<meta name="meta:word-count" content="{@meta:word-count}"/>
		<meta name="meta:image-count" content="{@meta:image-count}"/>
		<meta name="meta:table-count" content="{@meta:table-count}"/>
		<meta name="meta:object-count" content="{@meta:object-count}"/>
		<meta name="meta:character-count" content="{@meta:character-count}"/>
		<meta name="meta:paragraph-count" content="{@meta:paragraph-count}"/>
	</xsl:template>
  <xsl:template match="office:presentation">
		<xsl:apply-templates/>
	</xsl:template>
  <xsl:template match="presentation:notes"/>
  <xsl:template match="presentation:notes" mode="notes">
		<div>
			<xsl:call-template name="add_id"/>
			<xsl:call-template name="class"/>
			<xsl:apply-templates/>
		</div>
	</xsl:template>
  <xsl:template name="master-page">
		<xsl:variable name="name" select="@draw:master-page-name"/>
		
		<xsl:apply-templates select="//style:master-page[@style:name=$name]/*"/>
		
	</xsl:template>
  <xsl:template match="office:spreadsheet">
		<xsl:apply-templates/>
	</xsl:template>
  <xsl:template match="text:page-number">
		<xsl:if test="//office:presentation">
			<xsl:value-of select="count(ancestor-or-self::draw:page)+1"/>
		</xsl:if>
	</xsl:template>
  <xsl:template match="office:spreadsheet//table:table">
		<div>
			<xsl:call-template name="add_id"/>
			<xsl:attribute name="class">
				<xsl:text>masterpage_</xsl:text>
				<xsl:value-of select="//style:master-page[1]/@style:name"/>
			</xsl:attribute>
			<xsl:call-template name="table"/>
		</div>
		<div class="page-break"/>
	</xsl:template>
  <xsl:template match="table:table" name="table">
		<table>
			<xsl:call-template name="add_id"/>
			<xsl:call-template name="class"/>
			<xsl:if test="@table:name">
				<xsl:attribute name="title">
					<xsl:value-of select="@table:name"/>
				</xsl:attribute>
			</xsl:if>

			<xsl:variable name="max_row_width">
				<xsl:for-each select=".//table:table-row">
					<xsl:sort select="count(.//table:table-cell[not(last()) or child::*])" data-type="number" order="descending"/>
					<xsl:if test="position() = 1">
						<xsl:value-of select="count(.//table:table-cell[not(last()) or child::*])"/>
					</xsl:if>
				</xsl:for-each>
			</xsl:variable>

			<xsl:variable name="common_columns" select="count(.//table:table-column[not(@table:number-columns-repeated)])"/>
			<xsl:variable name="repeated_columns" select="sum(.//table:table-column/@table:number-columns-repeated)"/>
			<xsl:variable name="real_columns">
				<xsl:choose>
					<xsl:when test=".//table:table-column[last()]/@table:number-columns-repeated &gt; 64">
						<xsl:value-of select="$common_columns + $repeated_columns - number(.//table:table-column[last()]/@table:number-columns-repeated) + 1"/>
					</xsl:when>
					<xsl:otherwise>
						<xsl:value-of select="$common_columns + $repeated_columns"/>
					</xsl:otherwise>
				</xsl:choose>
			</xsl:variable>

			<xsl:variable name="max_columns">
				<xsl:choose>
					<xsl:when test="$max_row_width &gt; $real_columns">
						<xsl:value-of select="$max_row_width"/>
					</xsl:when>
					<xsl:otherwise>
						<xsl:value-of select="$real_columns"/>
					</xsl:otherwise>
				</xsl:choose>
			</xsl:variable>

			<xsl:variable name="column_styles">
				<xsl:for-each select=".//table:table-column">
					<xsl:call-template name="pre_scan_columns">
						<xsl:with-param name="num_cols" select="$max_columns"/>
					</xsl:call-template>
				</xsl:for-each>
			</xsl:variable>

			<xsl:value-of select="$linebreak"/>

			<xsl:apply-templates select="*">
				<xsl:with-param name="num_cols" select="$max_columns"/>
				<xsl:with-param name="col_styles" select="$column_styles"/>
			</xsl:apply-templates>
		</table>
		<xsl:value-of select="$linebreak"/>
	</xsl:template>
  <xsl:template name="pre_scan_columns">
		<xsl:param name="num_cols"/>
		<xsl:variable name="common_columns_before" select="count(preceding-sibling::*[not(@table:number-columns-repeated)])"/>
		<xsl:variable name="repeated_columns_before" select="sum(preceding-sibling::*/@table:number-columns-repeated)"/>
		<xsl:variable name="column_position" select="$common_columns_before + $repeated_columns_before"/>
		<xsl:call-template name="repeat_scanned_column">
			<xsl:with-param name="column_position">
				<xsl:value-of select="$column_position"/>
			</xsl:with-param>
			<xsl:with-param name="repeat">
				<xsl:call-template name="smart_repeat">
					<xsl:with-param name="value" select="@table:number-columns-repeated"/>
					<xsl:with-param name="is_last" select="last()"/>
					<xsl:with-param name="replace_last" select="$num_cols - $column_position"/>
				</xsl:call-template>
			</xsl:with-param>
		</xsl:call-template>
	</xsl:template>
  <xsl:template name="repeat_scanned_column">
		<xsl:param name="column_position"/>
		<xsl:param name="offset" select="1"/>
		<xsl:param name="repeat"/>
		<xsl:value-of select="concat(string($column_position + $offset),':',string(@table:default-cell-style-name),',')"/>
		<xsl:if test="$repeat &gt; 1">
			<xsl:call-template name="repeat_scanned_column">
				<xsl:with-param name="column_position" select="$column_position"/>
				<xsl:with-param name="offset" select="$offset + 1"/>
				<xsl:with-param name="repeat" select="$repeat - 1"/>
			</xsl:call-template>
		</xsl:if>
	</xsl:template>
  <xsl:template match="table:table-column-group|table:table-row-group">
		<xsl:param name="num_cols"/>
		<xsl:param name="col_styles"/>
		<xsl:apply-templates select="*">
			<xsl:with-param name="num_cols" select="$num_cols"/>
			<xsl:with-param name="col_styles" select="$col_styles"/>
			<xsl:with-param name="visibility">
				<xsl:choose>
					<xsl:when test="@table:display = 'true'">visible</xsl:when>
					<xsl:when test="@table:display = 'false'">collapse</xsl:when>
					<xsl:otherwise>_undefined</xsl:otherwise>
				</xsl:choose>
			</xsl:with-param>
		</xsl:apply-templates>
	</xsl:template>
  <xsl:template match="table:table-header-columns|table:table-columns">
		<xsl:param name="num_cols"/>
		<xsl:param name="visibility" select="'_undefined'"/>
		<colgroup>
			<xsl:if test="self::table:table-header-columns">
				<xsl:attribute name="class">thead</xsl:attribute>
			</xsl:if>
		<xsl:value-of select="$linebreak"/>
			<xsl:apply-templates select="*">
				<xsl:with-param name="num_cols" select="$num_cols"/>
				<xsl:with-param name="visibility" select="$visibility"/>
			</xsl:apply-templates>
		</colgroup> <xsl:value-of select="$linebreak"/>
	</xsl:template>
  <xsl:template match="table:table-header-rows|table:table-rows">
		<xsl:param name="num_cols"/>
		<xsl:param name="col_styles"/>
		<xsl:param name="visibility" select="'_undefined'"/>
		<xsl:variable name="block_type">
			<xsl:choose>
				<xsl:when test="self::table:table-header-rows">thead</xsl:when>
				<xsl:otherwise>tbody</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		<xsl:element name="{$block_type}">
			<xsl:apply-templates select="*">
				<xsl:with-param name="num_cols" select="$num_cols"/>
				<xsl:with-param name="col_styles" select="$col_styles"/>
				<xsl:with-param name="visibility" select="$visibility"/>
			</xsl:apply-templates>
		</xsl:element>
	</xsl:template>
  <xsl:template match="table:table-column">
		<xsl:param name="num_cols"/>
		<xsl:param name="visibility" select="'_undefined'"/>
		<col>
			<xsl:call-template name="class"/>

			<xsl:if test="@table:number-columns-repeated">
				<xsl:variable name="common_columns_before" select="count(preceding-sibling::*[not(@table:number-columns-repeated)])"/>
				<xsl:variable name="repeated_columns_before" select="sum(preceding-sibling::*/@table:number-columns-repeated)"/>
				<xsl:variable name="column_position" select="$common_columns_before + $repeated_columns_before"/>
				<xsl:attribute name="span">
					<xsl:call-template name="smart_repeat">
						<xsl:with-param name="value" select="@table:number-columns-repeated"/>
						<xsl:with-param name="is_last" select="last()"/>
						<xsl:with-param name="replace_last" select="$num_cols - $column_position"/>
					</xsl:call-template>
				</xsl:attribute>
			</xsl:if>

			<xsl:variable name="custom_style">
				<xsl:if test="$num_cols = 1">
					<xsl:text>width:100%;</xsl:text>
				</xsl:if>
				<xsl:call-template name="column_row_visibility">
					<xsl:with-param name="visibility" select="$visibility"/>
				</xsl:call-template>
			</xsl:variable>
			<xsl:if test="string($custom_style)">
				<xsl:attribute name="style">
					<xsl:value-of select="$custom_style"/>
				</xsl:attribute>
			</xsl:if>
		</col>
		<xsl:value-of select="$linebreak"/>
	</xsl:template>
  <xsl:template match="table:table-row">
		<xsl:param name="num_cols"/>
		<xsl:param name="col_styles"/>
		<xsl:param name="visibility" select="'_undefined'"/>
		<xsl:variable name="row_repeat">
			<xsl:call-template name="smart_repeat">
				<xsl:with-param name="value" select="@table:number-rows-repeated"/>
				<xsl:with-param name="is_last" select="last()"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:variable name="row_style">
			<xsl:call-template name="cell_style_name">
				<xsl:with-param name="style" select="@table:default-cell-style-name"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:call-template name="repeat-table-row">
			<xsl:with-param name="num_cols" select="$num_cols"/>
			<xsl:with-param name="col_styles" select="$col_styles"/>
			<xsl:with-param name="row_style" select="$row_style"/>
			<xsl:with-param name="visibility" select="$visibility"/>
			<xsl:with-param name="repeat" select="$row_repeat"/>
		</xsl:call-template>
	</xsl:template>
  <xsl:template name="repeat-table-row">
		<xsl:param name="num_cols"/>
		<xsl:param name="col_styles"/>
		<xsl:param name="row_style" select="''"/>
		<xsl:param name="visibility" select="'_undefined'"/>
		<xsl:param name="repeat"/>
		<xsl:if test="$repeat &gt; 0">
			<tr>
				<xsl:call-template name="class"/>
				<xsl:variable name="custom_style">
					<xsl:call-template name="column_row_visibility">
						<xsl:with-param name="visibility" select="$visibility"/>
					</xsl:call-template>
				</xsl:variable>
				<xsl:if test="string($custom_style)">
					<xsl:attribute name="style">
						<xsl:value-of select="$custom_style"/>
					</xsl:attribute>
				</xsl:if>
				<xsl:value-of select="$linebreak"/>
				<xsl:apply-templates select="table:table-cell">
					<xsl:with-param name="num_cols" select="$num_cols"/>
					<xsl:with-param name="col_styles" select="$col_styles"/>
					<xsl:with-param name="row_style" select="$row_style"/>
				</xsl:apply-templates>
				<xsl:value-of select="$linebreak"/>
			</tr>
			<xsl:value-of select="$linebreak"/>
			<xsl:call-template name="repeat-table-row">
				<xsl:with-param name="num_cols" select="$num_cols"/>
				<xsl:with-param name="col_styles" select="$col_styles"/>
				<xsl:with-param name="row_style" select="$row_style"/>
				<xsl:with-param name="visibility" select="$visibility"/>
				<xsl:with-param name="repeat" select="$repeat - 1"/>
			</xsl:call-template>
		</xsl:if>
	</xsl:template>
  <xsl:template match="table:table-cell">
		<xsl:param name="num_cols"/>
		<xsl:param name="col_styles"/>
		<xsl:param name="row_style" select="''"/>

		<xsl:variable name="common_cells_before" select="count(preceding-sibling::*[not(@table:number-columns-repeated)])"/>
		<xsl:variable name="repeated_cells_before" select="sum(preceding-sibling::*/@table:number-columns-repeated)"/>
		<xsl:variable name="cell_position" select="$common_cells_before + $repeated_cells_before"/>

		<xsl:variable name="cell_repeat">
			<xsl:call-template name="smart_repeat">
				<xsl:with-param name="value" select="@table:number-columns-repeated"/>
				<xsl:with-param name="is_last" select="last()"/>
				<xsl:with-param name="replace_last" select="$num_cols - $cell_position"/>
			</xsl:call-template>
		</xsl:variable>

		<xsl:call-template name="repeat_table_cell">
			<xsl:with-param name="col_styles" select="$col_styles"/>
			<xsl:with-param name="row_style" select="$row_style"/>
			<xsl:with-param name="cell_position" select="$cell_position"/>
			<xsl:with-param name="repeat" select="$cell_repeat"/>
		</xsl:call-template>
	</xsl:template>
  <xsl:template name="repeat_table_cell">
		<xsl:param name="col_styles"/>
		<xsl:param name="row_style" select="''"/>
		<xsl:param name="cell_position"/>
		<xsl:param name="offset" select="1"/>
		<xsl:param name="repeat"/>
		<xsl:if test="$repeat &gt; 0">
			<td>
				<xsl:choose>
					<xsl:when test="@table:style-name">
						<xsl:call-template name="class"/>
					</xsl:when>
					<xsl:otherwise>
						<xsl:variable name="cell_key">
							<xsl:value-of select="concat(string($cell_position+$offset), ':')"/>
						</xsl:variable>
						<xsl:variable name="column_style">
							<xsl:value-of select="substring-before(substring-after($col_styles, $cell_key), ',')"/>
						</xsl:variable>
						<xsl:call-template name="class">
							<xsl:with-param name="prepend_style">
								<xsl:if test="string-length($row_style)">
									<xsl:value-of select="$row_style"/>
									<xsl:text> </xsl:text>
								</xsl:if>
								<xsl:if test="string-length($column_style)">
									<xsl:call-template name="cell_style_name">
										<xsl:with-param name="style" select="$column_style"/>
									</xsl:call-template>
								</xsl:if>
							</xsl:with-param>
						</xsl:call-template>
					</xsl:otherwise>
				</xsl:choose>
				<xsl:if test="@table:number-columns-spanned &gt; 1">
					<xsl:attribute name="colspan">
						<xsl:value-of select="@table:number-columns-spanned"/>
					</xsl:attribute>
				</xsl:if>
				<xsl:if test="@table:number-rows-spanned &gt; 1">
					<xsl:attribute name="rowspan">
						<xsl:value-of select="@table:number-rows-spanned"/>
					</xsl:attribute>
				</xsl:if>
				<xsl:choose>
					<xsl:when test="@table:formula">
						<xsl:attribute name="title">
							<xsl:value-of select="@table:formula"/>
						</xsl:attribute>
					</xsl:when>
					<xsl:when test="child::text:p">
<!-- temporary hack: copy cell value into TD title -->
						<xsl:attribute name="title">
							<xsl:value-of select="child::text:p"/>
						</xsl:attribute>
					</xsl:when>
				</xsl:choose>
				<xsl:if test="count(node())=0">
					<br/>
				</xsl:if>
				<xsl:apply-templates/>
			</td>
			<xsl:call-template name="repeat_table_cell">
				<xsl:with-param name="col_styles" select="$col_styles"/>
				<xsl:with-param name="row_style" select="$row_style"/>
				<xsl:with-param name="cell_position" select="$cell_position"/>
				<xsl:with-param name="offset" select="$offset + 1"/>
				<xsl:with-param name="repeat" select="$repeat - 1"/>
			</xsl:call-template>
		</xsl:if>
	</xsl:template>
  <xsl:template name="cell_style_name">
		<xsl:param name="style"/>
		<xsl:choose>
			<xsl:when test="boolean($style)">
				<xsl:text>table-cell_</xsl:text>
				<xsl:value-of select="$style"/>
			</xsl:when>
			<xsl:otherwise>
				<xsl:copy-of select="''"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
  <xsl:template name="smart_repeat">
	<!-- do not reproduce "endless spreadsheet" emulation -->
	<!-- in the row's last cells -->
		<xsl:param name="value"/>
		<xsl:param name="is_last"/>
		<xsl:param name="replace_last" select="1"/>
		<xsl:choose>
			<xsl:when test="($is_last or $is_last-1) and $value &gt; 64">
				<xsl:value-of select="$replace_last"/>
			</xsl:when>
			<xsl:when test="$value &gt; 1">
				<xsl:value-of select="$value"/>
			</xsl:when>
			<xsl:otherwise>1</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
  <xsl:template name="column_row_visibility">
		<xsl:param name="visibility" select="'_undefined'"/>
		<xsl:choose>
			<!-- negative own visibility overrides all -->
			<xsl:when test="@table:visibility and @table:visibility!='visible'">
				<xsl:text>visibility:collapse;</xsl:text>
			</xsl:when>
			<!-- visibility inherited from group defines result -->
			<xsl:when test="$visibility != '_undefined'">
				<xsl:text>visibility:</xsl:text>
				<xsl:value-of select="$visibility"/>
				<xsl:text>; </xsl:text>
			</xsl:when>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="office:text">
		<xsl:comment>page begin</xsl:comment>
		<div class="page"> <!-- default page background color -->
			<div>
				<xsl:attribute name="class">
					<xsl:text>masterpage_</xsl:text>
					<xsl:value-of select="//style:master-page[1]/@style:name"/>
				</xsl:attribute>
				<xsl:apply-templates/>
			</div>
		</div>
		<xsl:comment>page end</xsl:comment>
	</xsl:template>
  <xsl:template match="text:p">
		<p>
			<xsl:call-template name="class"/>
			<xsl:apply-templates/>
			<!-- when paragraph is empty -->
			<xsl:if test="count(node())=0"><br/></xsl:if>
		</p>
	</xsl:template>
  <xsl:template match="text:span">
		<span>
			<xsl:call-template name="class"/>
			<xsl:apply-templates/>
		</span>
	</xsl:template>
  <xsl:template match="text:h">
	<!-- Heading levels go only to 6 in XHTML -->
		<xsl:variable name="level">
			<xsl:choose>
				<!-- text:outline-level is optional, default is 1 -->
				<xsl:when test="not(@text:outline-level)">1</xsl:when>
				<xsl:when test="@text:outline-level &gt; 6">6</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="@text:outline-level"/>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		
		<xsl:element name="{concat('h', $level)}">
			<xsl:call-template name="add_id"/>
			<xsl:call-template name="class"/>
			<a name="{generate-id()}"/>
			<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
  <xsl:template match="text:tab">
		<xsl:text xml:space="preserve"> </xsl:text>
	</xsl:template>
  <xsl:template match="text:line-break">
		<br/>
	</xsl:template>
  <xsl:variable name="spaces" xml:space="preserve"/>
  <xsl:template match="text:s">
		<xsl:choose>
			<xsl:when test="@text:c">
				<xsl:call-template name="insert-spaces">
					<xsl:with-param name="n" select="@text:c"/>
				</xsl:call-template>
			</xsl:when>
			<xsl:otherwise>
				<xsl:text> </xsl:text>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
  <xsl:template name="insert-spaces">
		<xsl:param name="n"/>
		<xsl:choose>
			<xsl:when test="$n &lt;= 30">
				<xsl:value-of select="substring($spaces, 1, $n)"/>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$spaces"/>
				<xsl:call-template name="insert-spaces">
					<xsl:with-param name="n">
						<xsl:value-of select="$n - 30"/>
					</xsl:with-param>
				</xsl:call-template>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="text:a">
		<a href="{@xlink:href}"><xsl:apply-templates/></a>
	</xsl:template>
  <xsl:template match="text:bookmark-start|text:bookmark">
		<a name="{@text:name}">
			<span style="font-size: 0px">
				<xsl:text> </xsl:text>
			</span>
		</a>
	</xsl:template>
  <xsl:template match="text:note">
		<xsl:variable name="footnote-id" select="text:note-citation"/>
		<a href="#footnote-{$footnote-id}">
			<xsl:call-template name="add_id"/>
			<sup><xsl:value-of select="$footnote-id"/></sup>
		</a>
	</xsl:template>
  <xsl:template match="text:note-body"/>
  <xsl:template name="add-footnote-bodies">
		<xsl:apply-templates select="//text:note" mode="add-footnote-bodies"/>
	</xsl:template>
  <xsl:template match="text:note" mode="add-footnote-bodies">
		<xsl:variable name="footnote-id" select="text:note-citation"/>
		<p><a name="footnote-{$footnote-id}"><sup><xsl:value-of select="$footnote-id"/></sup>:</a></p>
		<xsl:apply-templates select="text:note-body/*"/>
	</xsl:template>
  <xsl:template match="text:linenumbering-configuration"/>
  <xsl:template match="text:outline-style"/>
  <xsl:key name="listTypes" match="text:list-style" use="@style:name"/>
  <xsl:template match="text:list-style">
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* text:list-style '</xsl:text>
			<xsl:value-of select="@style:name"/>
			<xsl:text>' begin */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
		<xsl:apply-templates select="@*" mode="CSS-attr"/>
		<xsl:apply-templates/>
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* text:list-style '</xsl:text>
			<xsl:value-of select="@style:name"/>
			<xsl:text>' end */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
	</xsl:template>
  <xsl:template match="text:list-level-style-bullet|text:list-level-style-number">
		
		<xsl:variable name="node" select="name()"/>
		<xsl:variable name="style-name" select="@text:style-name|../@style:name"/>
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* </xsl:text>
			<xsl:value-of select="$node"/>
			<xsl:text> '</xsl:text>
			<xsl:value-of select="$style-name"/>
			<xsl:text>' begin */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
		<xsl:value-of select="$linebreak"/>
		<xsl:text>.list_</xsl:text>
		<xsl:value-of select="translate($style-name,'.','_')"/>
		<xsl:text>_</xsl:text>
		<xsl:value-of select="@text:level"/>
		<xsl:value-of select="$linebreak"/>
		<xsl:text>{</xsl:text>
		
		<xsl:apply-templates select="@*" mode="CSS-attr"/>
		<xsl:apply-templates/>
		
		<xsl:text>}</xsl:text>
		<xsl:value-of select="$linebreak"/>
		
		<xsl:if test="$CSS.debug=1">
			<xsl:text>/* </xsl:text>
			<xsl:value-of select="$node"/>
			<xsl:text> '</xsl:text>
			<xsl:value-of select="$style-name"/>
			<xsl:text>' end */</xsl:text>
			<xsl:value-of select="$linebreak"/>
		</xsl:if>
		
	</xsl:template>
  <xsl:template match="text:list-level-style-bullet/@text:level" mode="CSS-attr">
		<xsl:text>list-style-type: </xsl:text>
			<xsl:choose>
				<xsl:when test="@text:level mod 3 = 1">disc</xsl:when>
				<xsl:when test="@text:level mod 3 = 2">circle</xsl:when>
				<xsl:when test="@text:level mod 3 = 0">square</xsl:when>
				<xsl:otherwise>disc</xsl:otherwise>
			</xsl:choose>
		<xsl:text>; </xsl:text>
	</xsl:template>
  <xsl:template match="text:list-level-style-number/@text:level" mode="CSS-attr">
		<xsl:text>list-style-type: </xsl:text>
			<xsl:choose>
				<xsl:when test="@style:num-format='1'">decimal</xsl:when>
				<xsl:when test="@style:num-format='I'">upper-roman</xsl:when>
				<xsl:when test="@style:num-format='i'">lower-roman</xsl:when>
				<xsl:when test="@style:num-format='A'">upper-alpha</xsl:when>
				<xsl:when test="@style:num-format='a'">lower-alpha</xsl:when>
				<xsl:otherwise>decimal</xsl:otherwise>
			</xsl:choose>
		<xsl:text>; </xsl:text>
	</xsl:template>
  <xsl:template match="text:list">
		<xsl:variable name="level" select="count(ancestor::text:list)+1"/>
		<!--
			the list class is the @text:style-name of the outermost
			<text:list> element
		-->
		<xsl:variable name="listClass">
			<xsl:choose>
				<xsl:when test="$level=1">
					<xsl:value-of select="@text:style-name"/>
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="ancestor::text:list[last()]/@text:style-name"/>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		<!--
			Now select the <text:list-level-style-foo> element at this
			level of nesting for this list
		-->
		<xsl:variable name="node" select="key('listTypes',$listClass)/*[@text:level='$level']"/>
		<!-- emit appropriate list type -->
		<xsl:choose>
			<xsl:when test="local-name($node)='list-level-style-number'">
				<ol class="list_{concat($listClass,'_',$level)}">
					<xsl:apply-templates/>
				</ol>
			</xsl:when>
			<xsl:otherwise>
				<ul class="list_{concat($listClass,'_',$level)}">
					<xsl:apply-templates/>
				</ul>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="text:list-item">
		<li>
			<xsl:apply-templates/>
		</li>
	</xsl:template>
  <xsl:template match="text:table-of-content">
		<xsl:apply-templates/>
	</xsl:template>
  <xsl:template match="text:table-of-content-source"/>
  <xsl:template match="text:index-body">
		<xsl:apply-templates/>
	</xsl:template>
  <xsl:template match="text:tracked-changes">
		<xsl:comment> Document has track-changes on </xsl:comment>
	</xsl:template>
  <xsl:template match="text:change">
		<xsl:if test="$param_track_changes">
			<xsl:variable name="id" select="@text:change-id"/>
			<xsl:variable name="change" select="//text:changed-region[@text:id=$id]"/>
			<xsl:element name="del">
				<xsl:attribute name="datetime">
					<xsl:value-of select="$change//dc:date"/>
				</xsl:attribute>
				<xsl:apply-templates match="$change/text:deletion/*"/>
			</xsl:element>
		</xsl:if>
	</xsl:template>
  <xsl:template match="text:p//text()[count(preceding::text:change-start) &gt; count(preceding::text:change-end)][count(following::text:change-start) &lt; count(following::text:change-end)]">
		<xsl:choose>
			<xsl:when test="$param_track_changes">
				<ins><xsl:value-of select="."/></ins>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="."/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
  <xsl:template match="office:change-info"/>
</xsl:stylesheet>
